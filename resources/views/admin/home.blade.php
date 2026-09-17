@include('admin.header')

<div class="main-content">
    <div class="mb-4">
        <h2 class="admin-page-title">Dashboard</h2>
        <p class="admin-page-subtitle">Welcome, {{ Auth::guard('admin')->user()->name }}</p>
    </div>

    <!-- Quick Actions -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('manage.deposits.page') }}" class="btn btn-success btn-sm" style="border-radius:8px;">
            <i class="bi bi-box-arrow-in-down me-1"></i> Deposits
        </a>
        <a href="{{ route('manage.withdrawals.page') }}" class="btn btn-danger btn-sm" style="border-radius:8px;">
            <i class="bi bi-box-arrow-up me-1"></i> Withdrawals
        </a>
        <a href="{{ route('manage.users.page') }}" class="btn btn-secondary btn-sm" style="border-radius:8px;">
            <i class="bi bi-people me-1"></i> Users
        </a>
    </div>

    <!-- Stats Row 1 -->
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="admin-stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: rgba(234,179,8,0.15); color:#eab308;">
                        <i class="bi bi-box-arrow-in-down"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Deposit</div>
                        <div class="stat-value">${{ number_format($total_deposits, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: rgba(59,130,246,0.15); color:#3b82f6;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <div class="stat-label">Pending Deposits</div>
                        <div class="stat-value">${{ number_format($pending_deposits_sum, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: rgba(239,68,68,0.15); color:#ef4444;">
                        <i class="bi bi-box-arrow-up"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Withdrawal</div>
                        <div class="stat-value">${{ number_format($total_withdrawals, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: rgba(168,85,247,0.15); color:#a855f7;">
                        <i class="bi bi-hourglass-bottom"></i>
                    </div>
                    <div>
                        <div class="stat-label">Pending Withdrawal</div>
                        <div class="stat-value">${{ number_format($pending_withdrawals_sum, 2) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Row 2 -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: rgba(34,197,94,0.15); color:#22c55e;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Users</div>
                        <div class="stat-value">{{ $total_users }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: rgba(239,68,68,0.15); color:#ef4444;">
                        <i class="bi bi-person-x-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Blocked Users</div>
                        <div class="stat-value">{{ $suspended_users }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: rgba(34,197,94,0.15); color:#22c55e;">
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Active Users</div>
                        <div class="stat-value">{{ $total_users - $suspended_users }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: rgba(234,179,8,0.15); color:#eab308;">
                        <i class="bi bi-diagram-3-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Investment Plans</div>
                        <div class="stat-value">-</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="admin-card mb-4">
        <h6 class="fw-bold mb-3" style="color: var(--heading-color);">System Statistics</h6>
        <div style="overflow-x:auto;">
            <canvas id="myChart" height="100"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var isDark = document.documentElement.classList.contains('dark');
            var textColor = isDark ? '#a5bdd9' : '#4a4a4a';
            var gridColor = isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Deposit', 'Pending Deposit', 'Withdrawal', 'Pending Withdrawal'],
                    datasets: [{
                        label: 'Amount ($)',
                        data: [
                            {{ $total_deposits }},
                            {{ $pending_deposits_sum }},
                            {{ $total_withdrawals }},
                            {{ $pending_withdrawals_sum }}
                        ],
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.2)',
                            'rgba(59, 130, 246, 0.2)',
                            'rgba(239, 68, 68, 0.2)',
                            'rgba(234, 179, 8, 0.2)'
                        ],
                        borderColor: [
                            'rgba(34, 197, 94, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(239, 68, 68, 1)',
                            'rgba(234, 179, 8, 1)'
                        ],
                        borderWidth: 2,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { labels: { color: textColor } }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: textColor },
                            grid: { color: gridColor }
                        },
                        x: {
                            ticks: { color: textColor },
                            grid: { color: gridColor }
                        }
                    }
                }
            });
        });
    </script>
</div>

@include('admin.footer')