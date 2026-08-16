<?php
session_start();
if (isset($_SESSION['student_id'])) {
    // Updated redirect path to match your project structure
    header("Location: dashboard/student_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - Trisul Academy</title>

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #0b0f19;
            color: #d1d5db;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .auth-card {
            background-color: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 650px;
            position: relative;
        }

        /* Top accent line */
        .auth-card::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 20px;
            right: 20px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #0ea5e9, transparent);
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand-logo h3 {
            color: #ffffff;
            font-weight: 800;
            margin: 0;
            font-size: 1.8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .brand-logo span {
            color: #0ea5e9;
        }

        .brand-logo p {
            color: #64748b;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-label {
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            background-color: #131b2e;
            border: 1px solid #1e2d4a;
            color: #ffffff;
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #131b2e;
            border-color: #0ea5e9;
            color: #ffffff;
            box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25);
        }

        .form-control::placeholder {
            color: #475569;
        }

        /* Invert calendar icon for dark mode */
        ::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
            opacity: 0.6;
        }

        ::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }

        .btn-auth {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            border: none;
            color: #ffffff;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 14px 20px;
            border-radius: 8px;
            text-transform: uppercase;
            font-size: 0.95rem;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 15px;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
            color: #fff;
        }

        .auth-links {
            text-align: center;
            margin-top: 25px;
        }

        .auth-links a {
            color: #0ea5e9;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: #38bdf8;
            text-decoration: underline;
        }

        /* Custom Alert Styles */
        .alert-custom-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
            border-radius: 8px;
            padding: 12px;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .alert-custom-error {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 8px;
            padding: 12px;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        /* Mobile adjustments */
        @media screen and (max-width: 576px) {
            .auth-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <div class="brand-logo">
            <h3>TRISUL <span>ACADEMY</span></h3>
            <p>Secure Student Registration Portal</p>
        </div>

        <div id="reg-alert"></div>

        <form id="studentRegForm">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text" style="background-color: #1e2d4a; border-color: #1e2d4a; color: #94a3b8;">
                        <i class="bi bi-person"></i>
                    </span>
                    <input type="text" name="student_name" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: #1e2d4a; border-color: #1e2d4a; color: #94a3b8;">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: #1e2d4a; border-color: #1e2d4a; color: #94a3b8;">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background-color: #1e2d4a; border-color: #1e2d4a; color: #94a3b8;">
                            <i class="bi bi-telephone"></i>
                        </span>
                        <input type="number" name="phone" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="" disabled selected>Select Gender...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Residential Address</label>
                <textarea name="address" class="form-control" rows="2" required></textarea>
            </div>

            <button type="submit" class="btn-auth"><i class="bi bi-person-plus-fill me-2"></i> Create Account</button>

            <div class="auth-links">
                <a href="student_login.php">Already have an account? Log in securely</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#studentRegForm').submit(function(e) {
                e.preventDefault();

                // Show loading state on button
                var btn = $(this).find('.btn-auth');
                var originalText = btn.html();
                btn.html('<i class="bi bi-hourglass-split me-2"></i> Processing...');
                btn.prop('disabled', true);

                $.ajax({
                    url: 'Authentication/student_registration_process.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.trim() === 'success') {
                            $('#reg-alert').html('<div class="alert-custom-success"><i class="bi bi-check-circle-fill me-2"></i> Registration successful! Redirecting...</div>');
                            setTimeout(function() {
                                window.location.href = 'student_login.php';
                            }, 2000);
                        } else {
                            $('#reg-alert').html('<div class="alert-custom-error"><i class="bi bi-exclamation-triangle-fill me-2"></i> ' + response + '</div>');
                            btn.html(originalText);
                            btn.prop('disabled', false);
                        }
                    },
                    error: function() {
                        $('#reg-alert').html('<div class="alert-custom-error"><i class="bi bi-wifi-off me-2"></i> Network error occurred. Please try again.</div>');
                        btn.html(originalText);
                        btn.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>

</html>