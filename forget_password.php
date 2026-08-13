<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center mb-4">Reset Password</h4>
                    <p class="text-muted text-center small">Enter your email address and we will send you instructions to reset your password.</p>
                    <div id="reset-alert"></div>
                    <form id="forgetPasswordForm">
                        <div class="mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-3">Send Reset Link</button>
                        <div class="text-center">
                            <a href="login.php" class="text-decoration-none small">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#forgetPasswordForm').submit(function(e){
        e.preventDefault();
        $.ajax({
    url: 'ajax/auth_ajax.php',
    type: 'POST',
    data: $(this).serialize() + '&action=forget_password',
    success: function(response){
        $('#reset-alert').html('<div class="alert alert-info">If this email exists in our system, a reset link has been sent.</div>');
        $('#forgetPasswordForm')[0].reset();
    }
});
        $('#reset-alert').html('<div class="alert alert-info">If this email exists in our system, a reset link has been sent.</div>');
        $(this)[0].reset();
    });
});
</script>
</body>
</html>