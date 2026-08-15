<?php 
include 'includes/auth_check.php'; 
include 'config/dbcon.php';
include 'includes/header.php'; 
include 'includes/nav.php';

$students = $pdo->query("SELECT id, student_name FROM students")->fetchAll();
$courses = $pdo->query("SELECT id, course_name FROM courses")->fetchAll();
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

    /* Amber accent line for Enrollments */
    .dashboard-frame::before {
        content: '';
        position: absolute;
        top: -1px; left: 20px; right: 20px; height: 1px;
        background: linear-gradient(90deg, transparent, #f59e0b, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #f59e0b;
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

    /* Form Box Styling */
    .form-box {
        background-color: #131b2e;
        border: 1px solid #1e2d4a;
        border-radius: 10px;
        padding: 24px;
        margin-bottom: 30px;
    }

    .form-label {
        color: #94a3b8;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        background-color: #0f172a;
        border: 1px solid #1e2d4a;
        color: #ffffff;
        border-radius: 8px;
        padding: 10px 16px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background-color: #0f172a;
        border-color: #f59e0b;
        color: #ffffff;
        box-shadow: 0 0 12px rgba(245, 158, 11, 0.2);
    }


    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    }

    
    .btn-add {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border: none;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 0 20px;
        border-radius: 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        height: 45px; 
        white-space: nowrap;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #d97706, #b45309);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.5);
    }

   
    .table-custom {
        color: #d1d5db;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .table-custom thead th {
        background-color: transparent;
        color: #94a3b8;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        border: none;
        padding: 0 16px 8px 16px;
    }

    .table-custom tbody tr {
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        transition: transform 0.2s ease;
    }

    .table-custom tbody tr:hover {
        transform: translateY(-2px);
    }

    .table-custom tbody td {
        background-color: #131b2e !important;
        color: #f8fafc !important;
        border: 1px solid #1e2d4a;
        border-style: solid none;
        padding: 16px;
        vertical-align: middle;
        font-size: 0.95rem;
        transition: background-color 0.2s ease;
    }

    .table-custom tbody tr:hover td {
        background-color: #1a263d !important;
    }

    .table-custom tbody td:first-child {
        border-left: 1px solid #1e2d4a;
        border-radius: 8px 0 0 8px;
    }

    .table-custom tbody td:last-child {
        border-right: 1px solid #1e2d4a;
        border-radius: 0 8px 8px 0;
    }

    
    .table-custom .removeBtn {
        background-color: rgba(239, 68, 68, 0.1) !important;
        border: 1px solid rgba(239, 68, 68, 0.3) !important;
        color: #ef4444 !important;
        border-radius: 6px;
        padding: 6px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .table-custom .removeBtn:hover {
        background-color: #ef4444 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }
    
  
    ::-webkit-calendar-picker-indicator {
        filter: invert(1);
        opacity: 0.6;
        cursor: pointer;
    }
</style>

<div class="container mt-4">
    <div class="dashboard-frame">
        
        <div class="section-title-tag">
            <h2>Enrollments</h2>
            <p>Assign students to active course programs</p>
        </div>

        <!-- Enrollment Form Box -->
        <div class="form-box">
           
            <form id="enrollForm" class="row align-items-end g-3">
                <input type="hidden" name="action" value="enroll">
                
                <div class="col-md-3">
                    <label class="form-label"><i class="bi bi-person me-2"></i>Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="" disabled selected>Select Student...</option>
                        <?php foreach($students as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['student_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label"><i class="bi bi-journal-text me-2"></i>Course</label>
                    <select name="course_id" class="form-select" required>
                        <option value="" disabled selected>Select Course...</option>
                        <?php foreach($courses as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['course_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label"><i class="bi bi-calendar3 me-2"></i>Date</label>
                    <input type="date" name="enrollment_date" class="form-control" required>
                </div>
                
                <div class="col-md-3">
                    <button type="submit" class="btn btn-add w-100">Enroll Student</button>
                </div>
            </form>
        </div>

        <!-- Enrollments Table -->
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Enrollment ID</th>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="enrollmentTableBody">
                    <!-- AJAX Data Populates Here -->
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                if(response.trim() === 'success') {
                    $('#enrollForm')[0].reset();
                    loadEnrollments();
                } else {
                    alert(response);
                }
            }
        });
    });

    $(document).on('click', '.removeBtn', function(){
        if(confirm("Are you sure you want to remove this student's enrollment?")) {
            var id = $(this).data('id');
            $.post('ajax/enrollment_ajax.php', {action: 'delete', id: id}, function(){
                loadEnrollments();
            });
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>