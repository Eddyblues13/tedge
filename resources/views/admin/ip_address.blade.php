@include('admin.header')

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="admin-page-title">IP Address Blacklist</h4>
                <p class="admin-page-subtitle">Block specific IP addresses from accessing the site</p>
            </div>
        </div>

        <div class="admin-card">
            <div class="row">
                <div class="col-md-8 offset-md-2 mb-4">
                    <form method="post" action="javascript:void(0)" id="ipform">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" style="color:var(--heading-color);">IP Address</label>
                            <input type="text" name="ipaddress" id="ipaddress" class="admin-form-control">
                            <small style="color:var(--text-color);opacity:0.7;">This IP address won't be able to access
                                your website.</small>
                        </div>
                        <button type="submit" class="btn btn-admin-primary"><i class="fas fa-ban me-1"></i>
                            Blacklist</button>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>IP Address</th>
                                    <th>Date Blacklisted</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody id="showipaddress">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let textinput = document.getElementById('ipaddress');
getallips();

function getallips(){
    fetch("account/admin/dashboard/allipaddress")
    .then(res => res.json())
    .then(response => {
        if(response.status === 200){
            document.getElementById('showipaddress').innerHTML = response.data;
        }
    })
    .catch(err => console.log(err));
}

function deleteip(id){
    fetch("account/admin/dashboard/delete-ip/" + id)
    .then(res => res.json())
    .then(response => {
        if(response.status === 200){
            toastr.success(response.success);
            getallips();
        }
    })
    .catch(err => console.log(err));
}

$('#ipform').on('submit', function() {
    $.ajax({
        url: "account/admin/dashboard/add-ip",
        type: 'POST',
        data: $('#ipform').serialize(),
        success: function(response) {
            if (response.status === 200) {
                textinput.value = "";
                toastr.success(response.success);
                getallips();
            }
        },
        error: function(error) {
            console.log(error);
        },
    });
});
</script>

@include('admin.footer')