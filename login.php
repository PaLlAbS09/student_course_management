<?php 
session_start(); 
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard/admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Admin Login</h4>
                        
                        <div id="login-alert"></div>
                        
                        <form id="loginForm">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div> 
                            
                    
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember_me">
                                <label class="form-check-label select-none" for="rememberMe">Remember me</label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                            
                         
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <a href="./admin_registration.php" class="text-decoration-none small text-muted">New user? Register here</a>
                                <a href="forget_password.php" class="text-decoration-none small">Forgot Password?</a>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax/auth_ajax.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response == 'success') {
                            window.location.href = 'index.php';
                        } else {
                            $('#login-alert').html('<div class="alert alert-danger">' + response + '</div>');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>