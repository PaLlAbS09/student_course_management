<?php 
include 'config/auth.php'; 
include 'includes/header.php'; 
include 'includes/nav.php';
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Change Admin Password</h5>
                </div>
                <div class="card-body">
                    <div id="password-alert"></div>
                    <form id="changePasswordForm">
                        <div class="mb-3">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#changePasswordForm').submit(function(e){
        e.preventDefault();
        
        var new_pass = $('input[name="new_password"]').val();
        var conf_pass = $('input[name="confirm_password"]').val();
        
        if(new_pass !== conf_pass) {
            $('#password-alert').html('<div class="alert alert-danger">New passwords do not match.</div>');
            return;
        }

        $.ajax({
            url: 'Authentication/change_process.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
                if(response === 'success') {
                    $('#password-alert').html('<div class="alert alert-success">Password updated successfully!</div>');
                    $('#changePasswordForm')[0].reset();
                } else {
                    $('#password-alert').html('<div class="alert alert-danger">'+response+'</div>');
                }
            }
        });
    });
});
</script>
<?php include 'includes/footer.php'; ?>