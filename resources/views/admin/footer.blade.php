<!-- jQuery + Bootstrap JS + DataTables + Toastr -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>

<script>
    // Handle sidebar
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('adminSidebar');
        if (sidebar) {
            sidebar.addEventListener('shown.bs.offcanvas', () => {});
            sidebar.addEventListener('hidden.bs.offcanvas', () => {});
        }
    });
</script>

<!-- Admin Notification System -->
<script>
    (function() {
    let lastKnownId = 0;
    let isFirstLoad = true;

    function fetchNotifications() {
        fetch('{{ route("admin.notifications.json") }}')
            .then(r => r.json())
            .then(data => {
                renderDropdown(data.notifications);
                updateBadge(data.unread_count);

                // Show toast for NEW notifications (not on first load)
                if (!isFirstLoad && data.notifications.length > 0) {
                    const newest = data.notifications[0];
                    if (newest.id > lastKnownId) {
                        showNotifToast(newest);
                    }
                }
                if (data.notifications.length > 0) {
                    lastKnownId = data.notifications[0].id;
                }
                isFirstLoad = false;
            })
            .catch(() => {});
    }

    function renderDropdown(notifications) {
        const list = document.getElementById('notifList');
        if (!list) return;

        if (notifications.length === 0) {
            list.innerHTML = '<div class="notif-empty"><i class="bi bi-bell-slash d-block"></i><span style="font-size:13px;">No notifications yet</span></div>';
            return;
        }

        list.innerHTML = notifications.map(n => `
            <div class="notif-item ${n.is_read ? '' : 'unread'}" onclick="markRead(${n.id}, this)">
                <div class="notif-item-icon" style="background:${n.bg};color:${n.color};">
                    <i class="bi ${n.icon}"></i>
                </div>
                <div class="notif-item-content">
                    <div class="notif-item-title">${n.title}</div>
                    <div class="notif-item-msg">${n.message}</div>
                    <div class="notif-item-time">${n.time}</div>
                </div>
                ${!n.is_read ? '<div style="width:8px;height:8px;border-radius:50%;background:#6366f1;flex-shrink:0;margin-top:6px;"></div>' : ''}
            </div>
        `).join('');
    }

    function updateBadge(count) {
        const badge = document.getElementById('notifBadge');
        if (!badge) return;
        if (count > 0) {
            badge.textContent = count > 99 ? '99+' : count;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }

    // Toggle dropdown
    window.toggleNotifDropdown = function(e) {
        e.stopPropagation();
        const dd = document.getElementById('notifDropdown');
        dd.classList.toggle('show');
    };

    // Close on outside click
    document.addEventListener('click', function(e) {
        const wrap = document.getElementById('notifBellWrap');
        const dd = document.getElementById('notifDropdown');
        if (wrap && dd && !wrap.contains(e.target)) {
            dd.classList.remove('show');
        }
    });

    // Mark single as read
    window.markRead = function(id, el) {
        fetch(`{{ url('/account/admin/dashboard/notifications') }}/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        }).then(() => {
            el.classList.remove('unread');
            const dot = el.querySelector('div[style*="border-radius:50%"]');
            if (dot) dot.remove();
            fetchNotifications();
        });
    };

    // Mark all as read
    window.markAllRead = function() {
        fetch('{{ route("admin.notifications.readAll") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        }).then(() => fetchNotifications());
    };

    // Toast popup
    function showNotifToast(n) {
        // Remove any existing toast
        const old = document.querySelector('.notif-toast');
        if (old) old.remove();

        const toast = document.createElement('div');
        toast.className = 'notif-toast';
        toast.innerHTML = `
            <div class="notif-item-icon" style="background:${n.bg};color:${n.color};width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi ${n.icon}" style="font-size:18px;"></i>
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-size:13px;font-weight:700;color:var(--heading-color,#1e1b4b);margin-bottom:2px;">${n.title}</div>
                <div style="font-size:12px;color:var(--text-color,#6b7280);line-height:1.4;">${n.message}</div>
                <div style="font-size:11px;color:#9ca3af;margin-top:4px;">Just now</div>
            </div>
            <button onclick="this.parentElement.classList.add('hide');setTimeout(()=>this.parentElement.remove(),300)" style="background:none;border:none;color:var(--text-color,#9ca3af);font-size:16px;cursor:pointer;padding:0;line-height:1;flex-shrink:0;">&times;</button>
        `;
        document.body.appendChild(toast);

        // Play a subtle sound effect (optional — browser may block)
        // Auto-dismiss after 6 seconds
        setTimeout(() => {
            toast.classList.add('hide');
            setTimeout(() => toast.remove(), 300);
        }, 6000);
    }

    // Poll every 15 seconds
    fetchNotifications();
    setInterval(fetchNotifications, 15000);
})();
</script>

</body>

</html>