<?php 
include '../config/student_auth.php'; 
include '../config/dbcon.php'; 

$student_id = $_SESSION['student_id'];

$query = "
    SELECT c.course_code, c.course_name, c.duration, c.fees, c.description, e.enrollment_date 
    FROM enrollments e 
    INNER JOIN courses c ON e.course_id = c.id 
    WHERE e.student_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$student_id]);
$my_courses = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Student Portal</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome & Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #0b0f19;
            color: #d1d5db;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        /* Top Bar Navigation */
        .top-navbar {
            background-color: #0b0f19;
            padding: 18px 32px;
            border-bottom: 1px solid #1f293d;
        }

        .page-title {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
        }

        /* Container & Inner Frame */
        .dashboard-frame {
            background-color: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 28px;
            box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .dashboard-frame::before {
            content: '';
            position: absolute;
            top: -1px; left: 20px; right: 20px; height: 1px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .section-title-tag {
            border-left: 3px solid #3b82f6;
            padding-left: 10px;
        }

        .section-title-tag h5 {
            color: #ffffff;
            font-weight: 800;
            font-size: 0.95rem;
            letter-spacing: 1px;
            margin: 0;
            text-transform: uppercase;
        }

        .section-title-tag p {
            color: #64748b;
            font-size: 0.8rem;
            margin: 2px 0 0 0;
        }

        .attempt-badge {
            background-color: #13233b;
            border: 1px solid #1d3b66;
            color: #38bdf8;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 4px 12px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .attempt-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background-color: #38bdf8;
            border-radius: 50%;
        }

        /* Course Cards Styling */
        .course-card {
            background-color: #131b2e;
            border: 1px solid #1e2d4a;
            border-radius: 10px;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column; 
            justify-content: space-between;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .course-card:hover {
            transform: translateY(-3px);
            border-color: #2563eb;
        }

        .card-header-custom {
            background-color: #1a263d;
            border-radius: 8px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .course-icon-box {
            background-color: #2563eb;
            color: #ffffff;
            width: 36px;
            height: 36px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .course-title-text {
            color: #ffffff;
            font-weight: 700;
            font-size: 0.85rem;
            margin: 0;
            line-height: 1.3;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            flex-grow: 1;
        }

        .status-badge {
            background-color: #113147;
            border: 1px solid #16527a;
            color: #38bdf8;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        /* Card Details Rows */
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #1a263d;
            font-size: 0.82rem;
        }

        .detail-row:last-of-type {
            border-bottom: none;
        }

        .detail-label {
            color: #64748b;
        }

        .detail-value {
            color: #e2e8f0;
            font-weight: 600;
        }

        /* Highlighted Fee Box */
        .fee-highlight-box {
            background-color: #1c231a;
            border: 1px solid #3f5223;
            border-radius: 6px;
            padding: 10px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
            width: 100%;
        }

        .fee-label {
            color: #a3e635;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .fee-amount {
            color: #facc15;
            font-weight: 800;
            font-size: 1rem;
        }
    </style>
</head>
<body>

    <!-- Top Bar Navigation -->
    <div class="top-navbar d-flex justify-content-between align-items-center">
        <h1 class="page-title">My Courses</h1>
        <div class="d-flex align-items-center gap-3">
            <span class="text-secondary small me-2">Hello, <strong class="text-white"><?= htmlspecialchars($_SESSION['student_name']) ?></strong></span>
            
            <a href="../Authentication/student_logout.php" class="btn btn-outline-danger btn-sm ms-2" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container-fluid px-4 py-4">
        <div class="dashboard-frame">
            
            <!-- Section Header -->
            <div class="section-header">
                <div class="section-title-tag">
                    <h5>MY COURSES</h5>
                    <p>Your active courses and payment details</p>
                </div>
                <div class="attempt-badge">
                    ATTEMPT 1
                </div>
            </div>

            <!-- Cards Grid -->
            <?php if(count($my_courses) > 0): ?>
                <div class="row g-4">
                    <?php foreach($my_courses as $course): ?>
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="course-card">
                                <div>
                                    <!-- Header Box inside Card -->
                                    <div class="card-header-custom">
                                        <div class="course-icon-box">
                                            <i class="bi bi-mortarboard-fill"></i>
                                        </div>
                                        <h2 class="course-title-text"><?= htmlspecialchars($course['course_name']) ?></h2>
                                        <span class="status-badge">ENROLLED</span>
                                    </div>

                                    <!-- Detail Rows -->
                                    <div class="detail-row">
                                        <span class="detail-label">Duration</span>
                                        <span class="detail-value"><?= htmlspecialchars($course['duration']) ?> months</span>
                                    </div>
                                
                                    <div class="detail-row">
                                        <span class="detail-label">Category</span>
                                        <span class="detail-value"><?= htmlspecialchars($course['description'] ?? 'Job Oriented Course') ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="detail-label">Current Course Fee</span>
                                        <span class="detail-value">₹<?= number_format($course['fees'] ?? 0, 2) ?></span>
                                    </div>
                                </div>

                                <!-- Highlighted Bottom Fee Banner -->
                                <div class="fee-highlight-box">
                                    <span class="fee-label">Your Course Fee</span>
                                    <span class="fee-amount">₹<?= number_format($course['fees'] ?? 0, 2) ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-dark border-secondary text-center py-5">
                    <i class="bi bi-info-circle fs-2 text-info d-block mb-3"></i>
                    <h5 class="text-white">No Enrolled Courses Found</h5>
                    <p class="text-muted small">You are not currently enrolled in any courses. Please contact the administrator to enroll.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>