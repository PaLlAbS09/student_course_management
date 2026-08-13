<?php 
include '../includes/auth_check.php'; 
include '../config/dbcon.php'; 

$students_count = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn(); 
$courses_count = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn(); 
$enrollments_count = $pdo->query("SELECT COUNT(*) FROM enrollments")->fetchColumn(); 


include '../includes/header.php'; 
include '../includes/nav.php'; 
?>

<div class="container mt-4">     
    <h2>Dashboard</h2>     
    <div class="row mt-4">         
        <div class="col-md-4">             
            <div class="card text-white bg-primary mb-3 shadow-sm">                 
                <div class="card-body">                     
                    <h5 class="card-title">Total Students</h5>                     
                    <p class="card-text fs-2"><?= $students_count ?></p>                 
                </div>             
            </div>         
        </div>         
        <div class="col-md-4">             
            <div class="card text-white bg-success mb-3 shadow-sm">                 
                <div class="card-body">                     
                    <h5 class="card-title">Total Courses</h5>                     
                    <p class="card-text fs-2"><?= $courses_count ?></p>                 
                </div>             
            </div>         
        </div>         
        <div class="col-md-4">             
            <div class="card text-white bg-warning mb-3 shadow-sm">                 
                <div class="card-body">                     
                    <h5 class="card-title">Total Enrollments</h5>                     
                    <p class="card-text fs-2"><?= $enrollments_count ?></p>                 
                </div>             
            </div>         
        </div>     
    </div> 
</div> 

<?php 

include '../includes/footer.php'; 
?>