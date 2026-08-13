<?php 
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php"); 
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-dark">
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4 fw-bold">Admin Registration</h4>
                        
                      
                        <div id="reg-alert"></div>
                        
                        <form id="adminRegForm">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control" required >
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 mb-3 py-2 fw-bold">Register Admin</button>
                            
                            <div class="text-center">
                                <a href="login.php" class="text-decoration-none small text-muted">Already have an admin account? Login here</a>
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
            $('#adminRegForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'Authentication/admin_registration_process.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'success') {
                            $('#reg-alert').html('<div class="alert alert-success">Admin registered successfully! Redirecting to login...</div>');
                            $('#adminRegForm')[0].reset();
                            setTimeout(function(){ 
                                window.location.href = 'login.php'; 
                            }, 2000);
                            
                        } else {
                            $('#reg-alert').html('<div class="alert alert-danger">' + response + '</div>');
                        }
                    }, 
                    error: function() {
                        $('#reg-alert').html('<div class="alert alert-danger">An error occurred while processing the request.</div>');
                    }
                });
            });
        });
    </script>