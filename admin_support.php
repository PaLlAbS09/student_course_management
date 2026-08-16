<?php 
include 'includes/auth_check.php'; 
include 'includes/header.php'; 
include 'includes/nav.php';
include 'config/dbcon.php';

$query = "
    SELECT t.id, t.subject, t.message, t.status, t.created_at, s.student_name, s.email 
    FROM support_tickets t
    LEFT JOIN students s ON t.student_id = s.id
    ORDER BY t.created_at DESC
";
$stmt = $pdo->query($query);
$tickets = $stmt->fetchAll();
?>

<!-- Import Bootstrap Icons & Fonts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #0b0f19 !important;
        color: #d1d5db !important;
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
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
        top: -1px; left: 20px; right: 20px; height: 1px;
        background: linear-gradient(90deg, transparent, #ec4899, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #ec4899;
        padding-left: 12px;
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

  
    .table-custom {
        margin-top: 24px;
        color: #d1d5db;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .table-custom thead th {
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        border: none;
        padding: 0 16px 8px 16px;
    }

    .table-custom tbody tr {
        background-color: #131b2e;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        transition: transform 0.2s ease;
    }

    .table-custom tbody tr:hover {
        transform: translateY(-2px);
        background-color: #1a263d;
    }

    .table-custom tbody td {
        border: 1px solid #1e2d4a;
        border-style: solid none;
        padding: 16px;
        vertical-align: middle;
        font-size: 0.95rem;
    }

    .table-custom tbody td:first-child {
        border-left: 1px solid #1e2d4a;
        border-radius: 8px 0 0 8px;
    }

    .table-custom tbody td:last-child {
        border-right: 1px solid #1e2d4a;
        border-radius: 0 8px 8px 0;
    }

    .student-info {
        display: flex;
        flex-direction: column;
    }
    
    .student-name {
        color: #ffffff;
        font-weight: 600;
    }

    .student-email {
        color: #64748b;
        font-size: 0.8rem;
    }

   
    .status-badge {
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pending {
        background-color: rgba(245, 158, 11, 0.1);
        color: #fcd34d;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .badge-approved {
        background-color: rgba(16, 185, 129, 0.1);
        color: #6ee7b7;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .badge-rejected {
        background-color: rgba(239, 68, 68, 0.1);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

  
    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        transition: all 0.2s ease;
        margin-right: 5px;
    }

    .btn-approve {
        background-color: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    .btn-approve:hover {
        background-color: #10b981;
        color: #ffffff;
    }

    .btn-reject {
        background-color: rgba(239, 68, 68, 0.15);
        color: #ef4444;
    }

    .btn-reject:hover {
        background-color: #ef4444;
        color: #ffffff;
    }

    /* Mobile Responsive */
    @media screen and (max-width: 576px) {
        .dashboard-frame {
            padding: 15px;
            margin: 10px;
        }
        .table-custom tbody td, .table-custom thead th {
            white-space: nowrap;
        }
        .table-custom tbody td:nth-child(4) 
        {
            white-space: normal;
            min-width: 250px;
        }
    }
</style>

<div class="container mt-4">
    <div class="dashboard-frame">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="section-title-tag">
                <h2>Admin Support Center</h2>
                <p>Review and manage student support inquiries</p>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Student Details</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($tickets) > 0): ?>
                        <?php foreach($tickets as $t): ?>
                            <tr>
                                <td class="text-nowrap text-muted" style="font-size: 0.85rem;">
                                    <?= date('d M Y', strtotime($t['created_at'])) ?><br>
                                    <small><?= date('H:i A', strtotime($t['created_at'])) ?></small>
                                </td>
                                <td>
                                    <div class="student-info">
                                        <span class="student-name"><?= htmlspecialchars($t['student_name'] ?? 'Unknown User') ?></span>
                                        <span class="student-email"><?= htmlspecialchars($t['email'] ?? 'No Email') ?></span>
                                    </div>
                                </td>
                                <td class="fw-bold text-white"><?= htmlspecialchars($t['subject']) ?></td>
                                <td class="text-muted" style="font-size: 0.9rem;"><?= nl2br(htmlspecialchars($t['message'])) ?></td>
                                <td>
                                    <?php 
                                        // Default to pending if column is empty/null
                                        $status = $t['status'] ?? 'Pending';
                                        $badgeClass = 'badge-pending';
                                        if($status == 'Approved') $badgeClass = 'badge-approved';
                                        if($status == 'Rejected') $badgeClass = 'badge-rejected';
                                    ?>
                                    <span class="status-badge <?= $badgeClass ?> id-status-<?= $t['id'] ?>"><?= $status ?></span>
                                </td>
                                <td class="text-nowrap">
                                    <button class="btn-action btn-approve update-status-btn" data-id="<?= $t['id'] ?>" data-status="Approved">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button class="btn-action btn-reject update-status-btn" data-id="<?= $t['id'] ?>" data-status="Rejected">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No support tickets found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.update-status-btn').click(function(){
        var ticket_id = $(this).data('id');
        var new_status = $(this).data('status');
        var btnElement = $(this);
        
        
        if(new_status === 'Rejected' && !confirm("Are you sure you want to reject this ticket?")) {
            return;
        }

       
        var originalHtml = btnElement.html();
        btnElement.html('<i class="bi bi-hourglass-split"></i>');

        $.ajax({
            url: 'ajax/admin_support_ajax.php',
            type: 'POST',
            data: { 
                action: 'update_status', 
                ticket_id: ticket_id, 
                status: new_status 
            },
            success: function(response){
                if(response.trim() === 'success') {
                 
                    var badge = $('.id-status-' + ticket_id);
                    badge.text(new_status);
                    
                  
                    badge.removeClass('badge-pending badge-approved badge-rejected');
                    
                    
                    if(new_status === 'Approved') badge.addClass('badge-approved');
                    if(new_status === 'Rejected') badge.addClass('badge-rejected');
                } else {
                    alert('Error: ' + response);
                }
                
                btnElement.html(originalHtml);
            },
            error: function() {
                alert('A network error occurred.');
                btnElement.html(originalHtml);
            }
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>