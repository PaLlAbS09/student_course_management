<!DOCTYPE html> 
<html lang="en"> 
<head>    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Student Forgot Password - Hostel Management</title>    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    
    <!-- FontAwesome for the check icon in the success alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>        
        body {             
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);             
            display: flex;             
            align-items: center;             
            justify-content: center;             
            height: 100vh;             
            margin: 0;         
        }        
        .login-card {             
            width: 100%;             
            max-width: 450px;             
            padding: 40px;             
            border-radius: 15px;             
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);             
            background: #fff;             
            text-align: center;         
        }    
        
        /* Retained the custom alert styling for your success message */
        .alert-custom {
            border-radius: 12px;
            font-size: 0.85rem;
            text-align: left;
            border: none;
            background-color: #f0fdf4;
            color: #166534;
        }
    </style>
</head> 
<body>    
    <div class="login-card">        
        <h3 class="mb-4 text-primary fw-bold">Reset Password</h3>                                                            
        <p class="text-muted mb-4">Enter your registered student email address to verify your account.</p>            
        
        <div id="reset-alert"></div>
        
        <!-- Updated to use the ID required by your jQuery script -->
        <form id="forgetPasswordForm">                
            <div class="form-group mb-3 text-start">                    
                <label class="form-label fw-bold">Email Address</label>                    
                <input type="email" name="email" class="form-control" required placeholder="student@example.com">                
            </div>                
            
            <button type="submit" id="submitBtn" name="verify_email" class="btn btn-primary w-100 mb-3 py-2">
                <span class="btn-text">Verify Email</span>
                <span class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
            </button>                
            
            <a href="student_login.php" class="text-decoration-none text-danger" style="font-size: 14px;">Cancel & Return to Login</a>            
        </form>                            
    </div>

    <!-- jQuery and AJAX logic -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#forgetPasswordForm').submit(function(e){
            e.preventDefault();
         
            var $btn = $('#submitBtn');
            var $btnText = $btn.find('.btn-text');
            var $spinner = $btn.find('.spinner-border');
            var $form = $(this);
            
            // Trigger loading state
            $btn.prop('disabled', true);
            $btnText.text('Verifying...');
            $spinner.removeClass('d-none');
            $('#reset-alert').empty();
            
            $.ajax({
                url: 'ajax/auth_ajax.php',
                type: 'POST',
                data: $form.serialize() + '&action=forget_password',
                success: function(response){
              
                    $btn.prop('disabled', false);
                    $btnText.text('Verify Email');
                    $spinner.addClass('d-none');
                    
                    $('#reset-alert').html('<div class="alert alert-custom mb-4"><i class="fas fa-check-circle me-2"></i> If this email exists in our system, a reset link has been sent.</div>');
                    $form[0].reset();
                },
                error: function() {
                   
                    $btn.prop('disabled', false);
                    $btnText.text('Verify Email');
                    $spinner.addClass('d-none');
                    
                    $('#reset-alert').html('<div class="alert alert-custom mb-4"><i class="fas fa-check-circle me-2"></i> If this email exists in our system, a reset link has been sent.</div>');
                    $form[0].reset();
                }
            });
        });
    });
    </script>
</body> 
</html>