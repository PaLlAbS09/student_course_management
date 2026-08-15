<?php 
include 'includes/auth_check.php'; 
include 'config/dbcon.php';
include 'includes/header.php'; 
include 'includes/nav.php';

$course_report = $pdo->query("
    SELECT c.course_name, COUNT(e.student_id) as total_students 
    FROM courses c 
    LEFT JOIN enrollments e ON c.id = e.course_id 
    GROUP BY c.id
")->fetchAll();

$fee_report = $pdo->query("
    SELECT 
        MAX(fees) as highest_fee, 
        MIN(fees) as lowest_fee, 
        AVG(fees) as avg_fee, 
        SUM(fees) as total_fees 
    FROM courses
")->fetch();
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
        letter-spacing: 0.5px;
        margin: 0;
        text-transform: uppercase;
    }

    .section-title-tag p {
        color: #64748b;
        font-size: 0.85rem;
        margin: 4px 0 0 0;
    }


    .report-card {
        background-color: #131b2e;
        border: 1px solid #1e2d4a;
        border-radius: 10px;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        transition: transform 0.3s ease, border-color 0.3s ease;
    }

    .report-card:hover {
        transform: translateY(-3px);
        border-color: #334155;
    }

  
    .report-header {
        padding: 18px 20px;
        font-weight: 700;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 1px solid #1e2d4a;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header-blue {
        color: #38bdf8;
        background: linear-gradient(to right, rgba(56, 189, 248, 0.1), transparent);
        border-bottom: 1px solid rgba(56, 189, 248, 0.2);
    }

    .header-green {
        color: #10b981;
        background: linear-gradient(to right, rgba(16, 185, 129, 0.1), transparent);
        border-bottom: 1px solid rgba(16, 185, 129, 0.2);
    }


    .report-table {
        width: 100%;
        margin: 0;
    }

    .report-table th {
        background-color: #0f172a;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 12px 20px;
        border-bottom: 1px solid #1e2d4a;
    }

    .report-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #1e2d4a;
        vertical-align: middle;
        color: #f8fafc;
        font-size: 0.9rem;
        transition: background-color 0.2s ease;
    }

    .report-table tr:last-child td {
        border-bottom: none;
    }

    .report-table tr:hover td {
        background-color: rgba(255, 255, 255, 0.02);
    }

    .student-badge {
        background-color: rgba(56, 189, 248, 0.15);
        color: #38bdf8;
        padding: 4px 12px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.85rem;
        border: 1px solid rgba(56, 189, 248, 0.3);
        display: inline-block;
    }

   
    .analytics-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .analytics-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 20px;
        border-bottom: 1px solid #1e2d4a;
        transition: background-color 0.2s ease;
    }

    .analytics-item:hover {
        background-color: rgba(255, 255, 255, 0.02);
    }

    .analytics-item:last-child {
        border-bottom: none;
    }

    .analytics-label {
        color: #94a3b8;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .analytics-value {
        color: #facc15; 
        font-weight: 800;
        font-size: 1.05rem;
        font-family: monospace;
        letter-spacing: 0.5px;
    }
</style>

<div class="container mt-4">
    <div class="dashboard-frame">
        
        <div class="section-title-tag">
            <h2>System Reports</h2>
            <p>Analytical overview of enrollments and financial data</p>
        </div>

        <div class="row g-4 mt-2">
            
            <!-- Course Enrollment Report -->
            <div class="col-lg-6">
                <div class="report-card">
                    <div class="report-header header-blue">
                        <i class="bi bi-bar-chart-steps fs-5"></i> Course-wise Enrollment
                    </div>
                    <div class="table-responsive">
                        <table class="report-table">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th class="text-end">Total Students</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($course_report as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['course_name']) ?></td>
                                    <td class="text-end">
                                        <span class="student-badge"><?= $row['total_students'] ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           
            <div class="col-lg-6">
                <div class="report-card">
                    <div class="report-header header-green">
                        <i class="bi bi-cash-stack fs-5"></i> Course Fee Analytics
                    </div>
                    <ul class="analytics-list">
                        <li class="analytics-item">
                            <span class="analytics-label">Highest Course Fee</span>
                            <span class="analytics-value"><?= number_format($fee_report['highest_fee'], 2) ?></span>
                        </li>
                        <li class="analytics-item">
                            <span class="analytics-label">Lowest Course Fee</span>
                            <span class="analytics-value"><?= number_format($fee_report['lowest_fee'], 2) ?></span>
                        </li>
                        <li class="analytics-item">
                            <span class="analytics-label">Average Course Fee</span>
                            <span class="analytics-value"><?= number_format($fee_report['avg_fee'], 2) ?></span>
                        </li>
                        <li class="analytics-item">
                            <span class="analytics-label text-white">Total Potential Fees (All Courses)</span>
                            <span class="analytics-value text-success"><?= number_format($fee_report['total_fees'], 2) ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>