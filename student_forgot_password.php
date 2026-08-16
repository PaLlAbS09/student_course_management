<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Student Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
     
        body.dark-portal {
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
        body.dark-portal::before {
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
        .portal-card {
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
        .portal-title {
            font-weight: 700;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 15px;
            color: #ffffff;
        }
        .portal-subtitle {
            color: #94a3b8;
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        .user-email-display {
            color: #00e5ff;
            font-weight: 600;
        }
        .form-label {
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 500;
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
        .btn-portal {
            background: #1e293b;
            border: 1px solid #334155;
            color: #ffffff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-portal:hover {
            background: #334155;
            color: #ffffff;
        }
        .btn-primary-portal {
            background: #2563eb;
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-primary-portal:hover {
            background: #1d4ed8;
            color: #ffffff;
        }
        .custom-link {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            display: block;
            text-align: center;
            margin-top: 15px;
            transition: color 0.2s;
        }
        .custom-link:hover { color: #ffffff; }
        .success-box {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        .step-container { display: none; }
        .step-active { display: block; }
    </style>
</head>
<body class="dark-portal">

    <div class="portal-card">
        
        <!-- STEP 1: Verify Email -->
        <div id="step1" class="step-container step-active">
            <h2 class="portal-title">Reset Password</h2>
            <p class="portal-subtitle">Enter your email address to verify your account.</p>
            
            <form id="verifyEmailForm">
                <div class="mb-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" id="studentEmail" class="form-control" required placeholder="student@example.com">
                </div>
                <button type="submit" class="btn-portal w-100">Verify Email</button>
                <a href="student_login.php" class="custom-link">Cancel & Return to Login</a>
            </form>
        </div>

        <!-- STEP 2: Update Password -->
        <div id="step2" class="step-container">
            <h2 class="portal-title">Reset Password</h2>
            <p class="portal-subtitle">Create a new password for<br><span id="displayUserEmail" class="user-email-display"></span></p>
            
            <form id="updatePasswordForm">
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" id="newPassword" class="form-control" required placeholder="••••••••">
                </div>
                <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" id="confirmPassword" class="form-control" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn-primary-portal w-100">Update Password</button>
            </form>
        </div>

        <!-- STEP 3: Success -->
        <div id="step3" class="step-container">
            <h2 class="portal-title">Reset Password</h2>
            <div class="success-box">
                Password reset successfully! You can now log in.
            </div>
            <a href="student_login.php" class="btn-primary-portal w-100 d-block text-center text-decoration-none">Go to Login</a>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let verifiedEmail = '';

            
            $('#verifyEmailForm').submit(function(e) {
                e.preventDefault();
                verifiedEmail = $('#studentEmail').val();
                
                
                
                $('#displayUserEmail').text(verifiedEmail);
                $('#step1').removeClass('step-active');
                $('#step2').addClass('step-active');
            });

          
            $('#updatePasswordForm').submit(function(e) {
                e.preventDefault();
                const pass1 = $('#newPassword').val();
                const pass2 = $('#confirmPassword').val();

                if (pass1 !== pass2) {
                    alert('Passwords do not match!');
                    return;
                }

              
                   
                $('#step2').removeClass('step-active');
                $('#step3').addClass('step-active');
            });
        });
    </script>
</body>
</html>