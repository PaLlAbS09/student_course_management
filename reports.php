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

<div class="container mt-4">
    <h2 class="mb-4">System Reports</h2>
    
    <div class="row">
        
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Course-wise Student Enrollment</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Total Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($course_report as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['course_name']) ?></td>
                                <td><?= $row['total_students'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

   
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">Course Fee Analytics</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Highest Course Fee:</strong>
                            <span>$<?= number_format($fee_report['highest_fee'], 2) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Lowest Course Fee:</strong>
                            <span>$<?= number_format($fee_report['lowest_fee'], 2) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Average Course Fee:</strong>
                            <span>$<?= number_format($fee_report['avg_fee'], 2) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between border-bottom-0">
                            <strong>Total Potential Fees (All Courses):</strong>
                            <span>$<?= number_format($fee_report['total_fees'], 2) ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>