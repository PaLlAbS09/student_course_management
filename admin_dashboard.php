<?php
include 'includes/auth_check.php';
include 'config/dbcon.php';

$students_count =$pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
$courses_count =$pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
$enrollments_count =$pdo->query("SELECT COUNT(*) FROM enrollments")->fetchColumn();

include 'includes/header.php';
include 'includes/nav.php';
?>

<!-- Import Google Fonts & Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #0b0f19 !important;
        color: #d1d5db !important;
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
    }

    /* Override Navbar styling to match dark theme if needed */
    .navbar {
        background-color: #0f172a !important;
        border-bottom: 1px solid #1f293d;
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
        background: linear-gradient(90deg, transparent, #3b82f6, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #00e5ff;
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

    /* Stat Cards Styling */
    .stat-card {
        background-color: #131b2e;
        border: 1px solid #1e2d4a;
        border-radius: 10px;
        padding: 24px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .stat-card.students:hover {
        border-color: #3b82f6;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.15);
    }

    .stat-card.courses:hover {
        border-color: #10b981;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.15);
    }

    .stat-card.enrollments:hover {
        border-color: #f59e0b;
        box-shadow: 0 10px 30px rgba(245, 158, 11, 0.15);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .stat-title {
        color: #94a3b8;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
    }

    .stat-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .students .stat-icon-box {
        background-color: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .courses .stat-icon-box {
        background-color: rgba(16, 185, 129, 0.15);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .enrollments .stat-icon-box {
        background-color: rgba(245, 158, 11, 0.15);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .stat-value {
        color: #ffffff;
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        margin: 0;
    }

    .stat-footer {
        margin-top: 16px;
        padding-top: 12px;
        border-top: 1px solid #1a263d;
        font-size: 0.75rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    footer {
        color: #64748b !important;
    }
</style>

<div class="container">
    <div class="dashboard-frame">
        
        <div class="section-title-tag">
            <h2>Admin Dashboard</h2>
            <p>System overview, metrics, and quick statistics</p>
        </div>

        <div class="row g-4 mt-2">
            <!-- Total Students Card -->
            <div class="col-md-4">
                <div class="stat-card students">
                    <div>
                        <div class="stat-header">
                            <h5 class="stat-title">Total Students</h5>
                            <div class="stat-icon-box">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <p class="stat-value"><?= $students_count ?></p>
                    </div>
                    <div class="stat-footer">
                        <i class="bi bi-arrow-up-right text-primary"></i> Active registered student accounts
                    </div>
                </div>
            </div>

            <!-- Total Courses Card -->
            <div class="col-md-4">
                <div class="stat-card courses">
                    <div>
                        <div class="stat-header">
                            <h5 class="stat-title">Total Courses</h5>
                            <div class="stat-icon-box">
                                <i class="bi bi-journal-bookmark-fill"></i>
                            </div>
                        </div>
                        <p class="stat-value"><?= $courses_count ?></p>
                    </div>
                    <div class="stat-footer">
                        <i class="bi bi-arrow-up-right text-success"></i> Available academic programs
                    </div>
                </div>
            </div>

            <!-- Total Enrollments Card -->
            <div class="col-md-4">
                <div class="stat-card enrollments">
                    <div>
                        <div class="stat-header">
                            <h5 class="stat-title">Total Enrollments</h5>
                            <div class="stat-icon-box">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                        </div>
                        <p class="stat-value"><?= $enrollments_count ?></p>
                    </div>
                    <div class="stat-footer">
                        <i class="bi bi-arrow-up-right text-warning"></i> Course registrations recorded
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>