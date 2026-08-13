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
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Student Registration</h4>
                        <div id="reg-alert"></div>
                        <form id="studentRegForm">
                            <div class="mb-3">
                                <label>Full Name</label>
                                <input type="text" name="student_name" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Phone</label>
                                    <input type="number" name="phone" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="">Select...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100 mb-3">Register</button>
                            <div class="text-center">
                                <a href="student_login.php" class="text-decoration-none">Already have an account? Login here</a>
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
            $('#studentRegForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'Authentication/student_registration_process.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'success') {
                            $('#reg-alert').html('<div class="alert alert-success">Registration successful! Redirecting to login...</div>');
                            setTimeout(function(){ window.location.href = 'student_login.php'; }, 2000);
                        } else {
                            $('#reg-alert').html('<div class="alert alert-danger">' + response + '</div>');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>