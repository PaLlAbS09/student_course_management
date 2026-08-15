<?php 
include 'includes/auth_check.php'; 
include 'includes/header.php'; 
include 'includes/nav.php'; 
?>

<!-- Import Bootstrap Icons & Google Fonts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #0b0f19 !important;
        color: #d1d5db !important;
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
    }

    .security-frame {
        background-color: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 12px;
        padding: 40px;
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.5), 0 15px 35px rgba(0,0,0,0.3);
        position: relative;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    
    .security-frame::before {
        content: '';
        position: absolute;
        top: -1px; left: 20px; right: 20px; height: 1px;
        background: linear-gradient(90deg, transparent, #ff3366, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #ff3366;
        padding-left: 12px;
        margin-bottom: 30px;
    }

    .section-title-tag h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 1.4rem;
        letter-spacing: 0.5px;
        margin: 0;
        text-transform: uppercase;
    }

    .section-title-tag p {
        color: #64748b;
        font-size: 0.85rem;
        margin: 4px 0 0 0;
    }

    .form-label {
        color: #94a3b8;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .form-control {
        background-color: #131b2e;
        border: 1px solid #1e2d4a;
        color: #ffffff;
        border-radius: 8px;
        padding: 12px 16px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: #131b2e;
        border-color: #ff3366;
        color: #ffffff;
        box-shadow: 0 0 12px rgba(255, 51, 102, 0.2);
    }

    .form-control::placeholder {
        color: #475569;
    }

    .btn-update {
        background: linear-gradient(135deg, #ff3366, #be123c);
        border: none;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 12px 24px;
        border-radius: 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 51, 102, 0.3);
        width: 100%;
        margin-top: 10px;
    }

    .btn-update:hover {
        background: linear-gradient(135deg, #e11d48, #9f1239);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 51, 102, 0.5);
    }

    
    .alert-dark-danger {
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fca5a5;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }

    .alert-dark-success {
        background-color: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #6ee7b7;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }
</style>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="security-frame">
                
                <div class="section-title-tag">
                    <h2><i class="bi bi-shield-lock-fill me-2"></i>Security</h2>
                    <p>Update your administrator password</p>
                </div>
                
                <div id="password-alert"></div>
                
                <form id="changePasswordForm">
                    <div class="mb-4">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control"  required>
                    </div>
                    <button type="submit" class="btn btn-update"><i class="bi bi-check2-circle me-2"></i>Update Password</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#changePasswordForm').submit(function(e){
        e.preventDefault();
        
        var new_pass = $('input[name="new_password"]').val();
        var conf_pass = $('input[name="confirm_password"]').val();
        
        if(new_pass !== conf_pass) {
            $('#password-alert').html('<div class="alert-dark-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>New passwords do not match.</div>');
            return;
        }
        
        $.ajax({
            url: 'Authentication/change_process.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
                
                if(response.trim() === 'success') {
                    $('#password-alert').html('<div class="alert-dark-success"><i class="bi bi-check-circle-fill me-2"></i>Password updated successfully!</div>');
                    $('#changePasswordForm')[0].reset();
                } else {
                    $('#password-alert').html('<div class="alert-dark-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>'+response+'</div>');
                }
            }
        });
    });
}); 
</script>

<?php include 'includes/footer.php'; ?>