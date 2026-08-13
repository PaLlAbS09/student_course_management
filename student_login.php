<?php
session_start();
if (isset($_SESSION['student_id'])) {
    header("Location: dashboard/student_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body.student-login-body {
            background-color: #0b0f19;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            margin: 0;
        }

        /* Subtle background grid overlay */
        body.student-login-body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 1;
            pointer-events: none;
        }

        .login-card {
            background: #0f172a;
            border: 1px solid rgba(0, 229, 255, 0.2);
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), inset 0 0 20px rgba(0, 229, 255, 0.03);
            position: relative;
            z-index: 2;
        }

        .login-title {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: 1px;
            color: #ffffff;
            text-align: center;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 0.75rem;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .form-label {
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            background-color: #131b2e;
            border: 1px solid #1e2d4a;
            color: #ffffff;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #131b2e;
            border-color: #00e5ff;
            color: #ffffff;
            box-shadow: 0 0 12px rgba(0, 229, 255, 0.2);
        }

        .form-control::placeholder {
            color: #475569;
        }

        .btn-login {
            background: linear-gradient(135deg, #00e5ff, #2563eb);
            border: none;
            color: #050505;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 12px;
            border-radius: 8px;
            text-transform: uppercase;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 229, 255, 0.3);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #2563eb, #00e5ff);
            color: #ffffff;
            box-shadow: 0 6px 25px rgba(0, 229, 255, 0.5);
            transform: translateY(-2px);
        }

        .custom-link {
            color: #38bdf8;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.2s;
        }

        .custom-link:hover {
            color: #00e5ff;
            text-decoration: underline;
        }

        .alert-dark-custom {
            background-color: #1a1518;
            border: 1px solid #ef4444;
            color: #fca5a5;
            font-size: 0.85rem;
            border-radius: 8px;
        }
    </style>
</head>

<body class="student-login-body">
    <div class="login-card">
        <h2 class="login-title">Student Portal</h2>
        <p class="login-subtitle">Secure Access Login</p>
        
        <div id="login-alert"></div>
        
        <form id="studentLoginForm">
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="student@example.com" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            
            <div class="mb-4 text-end">
                <a href="student_forget_password.php" class="custom-link">Forgot Password?</a>
            </div>
            
            <button type="submit" class="btn btn-login w-100 mb-3">Access Portal</button>
            
            <div class="text-center mt-3">
                <span class="text-muted small">New here?</span> 
                <a href="student_registration.php" class="custom-link ms-1">Create Account</a>
            </div>
        </form>
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
                        if (response.trim() === 'success') {
                            window.location.href = 'dashboard/student_dashboard.php';
                        } else {
                            $('#login-alert').html('<div class="alert alert-dark-custom py-2 mb-3 text-center">' + response + '</div>');
                        }
                    },
                    error: function() {
                        $('#login-alert').html('<div class="alert alert-dark-custom py-2 mb-3 text-center">Connection error. Please try again.</div>');
                    }
                });
            });
        });
    </script>
</body>

</html>