<?php
include 'config/student_auth.php';
include 'config/dbcon.php';

$student_id = $_SESSION['student_id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$student_id]);
$student = $stmt->fetch();

include 'includes/header.php';
include 'includes/student_nav.php';
?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    body {
        background-color: #0b0f19;
        color: #d1d5db;
        font-family: 'Inter', sans-serif;
    }

    .dashboard-frame {
        background-color: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 12px;
        padding: 32px;
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.5);
        position: relative;
        margin-top: 20px;
        margin-bottom: 40px;
    }

    .dashboard-frame::before {
        content: '';
        position: absolute;
        top: -1px;
        left: 20px;
        right: 20px;
        height: 1px;
        background: linear-gradient(90deg, transparent, #0ea5e9, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #0ea5e9;
        padding-left: 12px;
        margin-bottom: 24px;
    }

    .section-title-tag h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 1.4rem;
        text-transform: uppercase;
        margin: 0;
    }

    .section-title-tag p {
        color: #64748b;
        font-size: 0.85rem;
        margin: 4px 0 0 0;
    }

  

    .security-card {
        border-top: 3px solid #ff3366;
    }


    .avatar-wrapper {
        text-align: center;
        margin-bottom: 20px;
    }

    .avatar-large {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 3px solid #0f172a;
        box-shadow: 0 0 20px rgba(14, 165, 233, 0.4);
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
        background-color: #0f172a;
        border: 1px solid #1e2d4a;
        color: #ffffff;
        border-radius: 8px;
        padding: 10px 16px;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #0f172a;
        color: #ffffff;
        box-shadow: none;
    }

    .profile-card .form-control:focus,
    .profile-card .form-select:focus {
        border-color: #0ea5e9;
    }

    .security-card .form-control:focus {
        border-color: #ff3366;
    }

    .form-control:disabled {
        background-color: #1e293b;
        color: #64748b;
        opacity: 0.7;
        cursor: not-allowed;
    }

    .btn-profile {
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        border: none;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 10px 20px;
        border-radius: 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        color: #fff;
    }

    .btn-security {
        background: linear-gradient(135deg, #ff3366, #be123c);
        border: none;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 10px 20px;
        border-radius: 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-security:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 51, 102, 0.4);
        color: #fff;
    }

    .alert-custom-success {
        background-color: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #6ee7b7;
        border-radius: 8px;
        padding: 10px;
        font-size: 0.9rem;
        display: none;
    }

    .alert-custom-error {
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fca5a5;
        border-radius: 8px;
        padding: 10px;
        font-size: 0.9rem;
        display: none;
    }
</style>

<div class="container-fluid px-4 py-4">
    <div class="dashboard-frame">

        <div class="section-title-tag">
            <h2>My Profile</h2>
            <p>Manage your personal information and account security</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="profile-card">
                    <div class="avatar-wrapper">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($student['student_name'] ?? 'Student') ?>&background=0ea5e9&color=fff&rounded=true&bold=true&size=128" alt="Profile" class="avatar-large">
                        <h4 class="text-white mt-3 mb-0"><?= htmlspecialchars($student['student_name'] ?? '') ?></h4>
                        <p class="text-muted small">Student ID: #STU-<?= str_pad($student['id'] ?? 0, 4, '0', STR_PAD_LEFT) ?></p>
                    </div>

                    <div id="profile-alert-success" class="alert-custom-success mb-3"><i class="bi bi-check-circle me-2"></i>Profile updated successfully!</div>
                    <div id="profile-alert-error" class="alert-custom-error mb-3"><i class="bi bi-exclamation-triangle me-2"></i>Error updating profile.</div>

                    <form id="updateProfileForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="student_name" class="form-control" value="<?= htmlspecialchars($student['student_name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address (Read Only)</label>
                                <input type="email" class="form-control" value="<?= htmlspecialchars($student['email'] ?? '') ?>" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="phone" class="form-control" value="<?= htmlspecialchars($student['phone'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" value="<?= htmlspecialchars($student['dob'] ?? '') ?>" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Residential Address</label>
                            <textarea name="address" class="form-control" rows="2" required><?= htmlspecialchars($student['address'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-profile"><i class="bi bi-person-check-fill me-2"></i>Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="security-card">
                    <h4 class="text-white mb-4"><i class="bi bi-shield-lock-fill me-2" style="color: #ff3366;"></i>Account Security</h4>

                    <div id="password-alert-success" class="alert-custom-success mb-3"><i class="bi bi-check-circle me-2"></i>Password updated securely.</div>
                    <div id="password-alert-error" class="alert-custom-error mb-3"><i class="bi bi-exclamation-triangle me-2"></i><span id="pass-err-msg">Error updating password.</span></div>

                    <form id="updatePasswordForm">
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Re-type new password" required>
                        </div>
                        <button type="submit" class="btn btn-security"><i class="bi bi-key-fill me-2"></i>Update Password</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#updateProfileForm').submit(function(e) {
            e.preventDefault();
            var btn = $(this).find('.btn-profile');
            btn.html('<i class="bi bi-hourglass-split me-2"></i>Saving...');

            $.ajax({
                url: 'ajax/update_student_profile.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.trim() === 'success') {
                        $('#profile-alert-success').fadeIn().delay(3000).fadeOut();
                    } else {
                        $('#profile-alert-error').fadeIn().delay(3000).fadeOut();
                    }
                    btn.html('<i class="bi bi-person-check-fill me-2"></i>Save Changes');
                }
            });
        });

        $('#updatePasswordForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var btn = form.find('.btn-security');
            var new_pass = $('input[name="new_password"]').val();
            var conf_pass = $('input[name="confirm_password"]').val();

            if (new_pass !== conf_pass) {
                $('#pass-err-msg').text("New passwords do not match.");
                $('#password-alert-error').fadeIn().delay(3000).fadeOut();
                return;
            }

            btn.html('<i class="bi bi-hourglass-split me-2"></i>Updating...');

            $.ajax({
                url: 'ajax/change_student_password.php',
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.trim() === 'success') {
                        $('#password-alert-success').fadeIn().delay(3000).fadeOut();
                        form[0].reset();
                    } else {
                        $('#pass-err-msg').text(response);
                        $('#password-alert-error').fadeIn().delay(3000).fadeOut();
                    }
                    btn.html('<i class="bi bi-key-fill me-2"></i>Update Password');
                }
            });
        });
    });
</script>

<?php include 'includes/footer.php'; ?>