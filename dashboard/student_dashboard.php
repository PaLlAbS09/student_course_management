<?php 
include '../config/student_auth.php'; 
include '../config/dbcon.php'; 

$student_id = $_SESSION['student_id'];

$query = "
    SELECT c.course_code, c.course_name, c.duration, e.enrollment_date 
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
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">Student Portal</a>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">Hello, <?= htmlspecialchars($_SESSION['student_name']) ?></span>
            <a href="../Authentication/student_logout.php" class="btn btn-sm btn-light">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="mb-4">My Enrolled Courses</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <?php if(count($my_courses) > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Duration (Months)</th>
                            <th>Enrollment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($my_courses as $course): ?>
                        <tr>
                            <td><?= htmlspecialchars($course['course_code']) ?></td>
                            <td><?= htmlspecialchars($course['course_name']) ?></td>
                            <td><?= htmlspecialchars($course['duration']) ?></td>
                            <td><?= htmlspecialchars($course['enrollment_date']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">You are not currently enrolled in any courses. Please contact the administrator to enroll.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>