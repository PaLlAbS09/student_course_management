<?php
include 'config/student_auth.php';
include 'config/dbcon.php';


$stmt = $pdo->query("SELECT * FROM notices ORDER BY date_posted DESC LIMIT 5");
$notices = $stmt->fetchAll();

include 'includes/header.php';
include 'includes/student_nav.php';
?>
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
    }

    .dashboard-frame::before {
        content: '';
        position: absolute;
        top: -1px;
        left: 20px;
        right: 20px;
        height: 1px;
        background: linear-gradient(90deg, transparent, #8b5cf6, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #8b5cf6;
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

    .notice-card {
        background-color: #131b2e;
        border-left: 4px solid #0ea5e9;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
    }

    .notice-date {
        color: #0ea5e9;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .notice-title {
        color: #ffffff;
        font-weight: 600;
        font-size: 1.1rem;
        margin: 5px 0;
    }

    .notice-body {
        color: #94a3b8;
        font-size: 0.9rem;
        margin: 0;
    }


    .empty-notice {
        color: #94a3b8;
        font-style: italic;
        font-size: 0.95rem;
    }

    .support-form {
        background-color: #131b2e;
        border: 1px solid #1e2d4a;
        border-radius: 10px;
        padding: 24px;
    }


    .custom-form-label {
        color: #94a3b8;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        background-color: #0f172a;
        border: 1px solid #1e2d4a;
        color: #ffffff;
        padding: 12px;
        border-radius: 8px;
    }

    .form-control:focus {
        background-color: #0f172a;
        border-color: #8b5cf6;
        color: #ffffff;
        box-shadow: 0 0 0 0.25rem rgba(139, 92, 246, 0.25);
    }


    .form-control::placeholder {
        color: #64748b;
        opacity: 1;
    }

    .btn-submit {
        background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
        width: 100%;
        transition: 0.3s;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.4);
        color: #fff;
    }

    .alert-custom {
        background-color: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #6ee7b7;
        border-radius: 8px;
        padding: 10px;
        font-size: 0.9rem;
        display: none;
    }
</style>

<div class="container-fluid px-4 py-4">
    <div class="dashboard-frame">
        <div class="row">

            <div class="col-lg-7 pe-lg-4 mb-5 mb-lg-0">
                <div class="section-title-tag" style="border-color: #0ea5e9;">
                    <h2>Notice Board</h2>
                    <p>Latest announcements from the administration</p>
                </div>

                <?php if (count($notices) > 0): ?>
                    <?php foreach ($notices as $n): ?>
                        <div class="notice-card">
                            <div class="notice-date"><i class="bi bi-calendar-event me-1"></i> <?= date('d M Y', strtotime($n['date_posted'])) ?></div>
                            <h4 class="notice-title"><?= htmlspecialchars($n['title']) ?></h4>
                            <p class="notice-body"><?= nl2br(htmlspecialchars($n['body'])) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>

                    <p class="empty-notice"><i class="bi bi-inbox me-2"></i>No new announcements at this time.</p>
                <?php endif; ?>
            </div>

            <div class="col-lg-5">
                <div class="section-title-tag">
                    <h2>Support Center</h2>
                    <p>Need help? Send a message to the admin</p>
                </div>

                <div class="support-form">
                    <div id="ticket-alert" class="alert-custom mb-3"><i class="bi bi-check-circle me-2"></i>Message sent successfully!</div>
                    <form id="supportForm">
                        <div class="mb-3">
                           
                            <label class="custom-form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            
                            <label class="custom-form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit"><i class="bi bi-send-fill me-2"></i>Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#supportForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var btn = form.find('.btn-submit');

            btn.html('<i class="bi bi-hourglass-split me-2"></i>Sending...');

            $.ajax({
                url: 'ajax/submit_ticket.php',
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.trim() === 'success') {
                        $('#ticket-alert').fadeIn().delay(3000).fadeOut();
                        form[0].reset();
                    } else {
                        alert('Error submitting message. Please try again.');
                    }
                    btn.html('<i class="bi bi-send-fill me-2"></i>Send Message');
                }
            });
        });
    });
</script>
<?php include 'includes/footer.php'; ?>