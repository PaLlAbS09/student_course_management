<?php 
include 'includes/auth_check.php'; 
include 'config/dbcon.php';
include 'includes/header.php'; 
include 'includes/nav.php';

$students = $pdo->query("SELECT id, student_name FROM students")->fetchAll();
$courses = $pdo->query("SELECT id, course_name FROM courses")->fetchAll();
?>
<div class="container mt-4">
    <h2>Enrollments</h2>
    
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form id="enrollForm" class="row align-items-end">
                <input type="hidden" name="action" value="enroll">
                <div class="col-md-4">
                    <label>Student</label>
                    <select name="student_id" class="form-control" required>
                        <option value="">Select Student...</option>
                        <?php foreach($students as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['student_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Course</label>
                    <select name="course_id" class="form-control" required>
                        <option value="">Select Course...</option>
                        <?php foreach($courses as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['course_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Date</label>
                    <input type="date" name="enrollment_date" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Enroll</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Enrollment ID</th>
                <th>Student Name</th>
                <th>Course Name</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="enrollmentTableBody"></tbody>
    </table>
</div>

<script>
function loadEnrollments() {
    $.ajax({
        url: 'ajax/enrollment_ajax.php',
        type: 'POST',
        data: { action: 'fetch' },
        success: function(response) {
            $('#enrollmentTableBody').html(response);
        }
    });
}

$(document).ready(function(){
    loadEnrollments();

    $('#enrollForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'ajax/enrollment_ajax.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
                if(response === 'success') {
                    $('#enrollForm')[0].reset();
                    loadEnrollments();
                } else {
                    alert(response);
                }
            }
        });
    });

    $(document).on('click', '.removeBtn', function(){
        var id = $(this).data('id');
        $.post('ajax/enrollment_ajax.php', {action: 'delete', id: id}, function(){
            loadEnrollments();
        });
    });
});
</script>
<?php require 'includes/footer.php'; ?>