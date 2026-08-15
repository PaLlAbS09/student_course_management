<?php

include 'config/student_auth.php';
include 'config/dbcon.php';

$student_id = $_SESSION['student_id'];


$fee_query = $pdo->prepare("
    SELECT SUM(c.fees) as total_fees 
    FROM enrollments e 
    JOIN courses c ON e.course_id = c.id 
    WHERE e.student_id = ?
");
$fee_query->execute([$student_id]);
$total_fees = $fee_query->fetchColumn() ?: 0;


$paid_query = $pdo->prepare("SELECT SUM(amount) as total_paid FROM payments WHERE student_id = ? AND status = 'Successful'");
$paid_query->execute([$student_id]);
$total_paid = $paid_query->fetchColumn() ?: 0;


$pending_dues = $total_fees - $total_paid;


$txn_query = $pdo->prepare("
    SELECT p.*, c.course_name 
    FROM payments p 
    JOIN courses c ON p.course_id = c.id 
    WHERE p.student_id = ? 
    ORDER BY p.payment_date DESC
");
$txn_query->execute([$student_id]);
$transactions = $txn_query->fetchAll();


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
    }

    .dashboard-frame::before {
        content: '';
        position: absolute;
        top: -1px;
        left: 20px;
        right: 20px;
        height: 1px;
        background: linear-gradient(90deg, transparent, #facc15, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #facc15;
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

    .finance-card {
        background-color: #131b2e;
        border: 1px solid #1e2d4a;
        border-radius: 10px;
        padding: 24px;
        text-align: center;
    }

    .finance-card h4 {
        color: #94a3b8;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .finance-card .amount {
        font-size: 2.2rem;
        font-weight: 800;
        color: #ffffff;
        margin: 10px 0;
    }

    .text-gold {
        color: #facc15 !important;
    }

    .text-green {
        color: #10b981 !important;
    }

    .table-custom {
        color: #d1d5db;
        margin-top: 20px;
    }

    .table-custom th {
        color: #94a3b8;
        text-transform: uppercase;
        font-size: 0.8rem;
        border: none;
        padding: 12px;
    }

    .table-custom td {
        background-color: #131b2e !important;
        color: #f8fafc !important;
        border: 1px solid #1e2d4a;
        border-style: solid none;
        padding: 16px;
        vertical-align: middle;
    }

    .table-custom td:first-child {
        border-left: 1px solid #1e2d4a;
        border-radius: 8px 0 0 8px;
    }

    .table-custom td:last-child {
        border-right: 1px solid #1e2d4a;
        border-radius: 0 8px 8px 0;
    }

    .badge-success {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
        padding: 5px 10px;
        border-radius: 6px;
    }
</style>

<div class="container-fluid px-4 py-4">
    <div class="dashboard-frame">
        <div class="section-title-tag">
            <h2>Financial Overview</h2>
            <p>Track your course fees and payment history</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="finance-card border-bottom border-success border-3">
                    <h4>Total Paid</h4>
                    <div class="amount text-green">₹<?= number_format($total_paid, 2) ?></div>
                    <span class="badge-success"><i class="bi bi-shield-check me-1"></i> Verified</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="finance-card border-bottom border-warning border-3">
                    <h4>Pending Dues</h4>
                    <div class="amount text-gold">₹<?= number_format($pending_dues > 0 ? $pending_dues : 0, 2) ?></div>
                    <?php if ($pending_dues > 0): ?>
                        <button class="btn btn-sm btn-outline-warning mt-2">Pay Now</button>
                    <?php else: ?>
                        <span class="text-muted small">No pending dues.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <h5 class="text-white mb-3"><i class="bi bi-clock-history me-2"></i>Recent Transactions</h5>
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Course</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($transactions) > 0): ?>
                        <?php foreach ($transactions as $txn): ?>
                            <tr>
                                <td><?= date('d M Y', strtotime($txn['payment_date'])) ?></td>
                                <td><?= htmlspecialchars($txn['course_name']) ?></td>
                                <td><?= htmlspecialchars($txn['transaction_id']) ?></td>
                                <td class="text-white fw-bold">₹<?= number_format($txn['amount'], 2) ?></td>
                                <td><span class="badge-success"><?= htmlspecialchars($txn['status']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No transactions found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>