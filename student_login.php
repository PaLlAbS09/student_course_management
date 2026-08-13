<?php 
session_start();
if (isset($_SESSION['student_id'])) {
    header("Location: student_dashboard/index.php");
}   
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Student Login</h4>
                        <div id="login-alert"></div>
                        <form id="studentLoginForm">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3 text-end">
                                <a href="student_forget_password.php" class="text-decoration-none small">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                            <div class="text-center">
                                <a href="student_registration.php" class="text-decoration-none">New here? Register</a>
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
            $('#studentLoginForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'Authentication/student_login_process.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'success') {
                            window.location.href = 'student_dashboard/index.php';
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