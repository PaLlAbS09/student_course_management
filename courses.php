<?php 
include 'includes/auth_check.php'; 
include 'includes/header.php'; 
include 'includes/nav.php';
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

    /* Green accent line for Courses */
    .dashboard-frame::before {
        content: '';
        position: absolute;
        top: -1px; left: 20px; right: 20px; height: 1px;
        background: linear-gradient(90deg, transparent, #10b981, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #10b981;
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

    /* Primary Action Button (Green Gradient) */
    .btn-add {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 10px 24px;
        border-radius: 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #059669, #047857);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
    }

    /* Custom Table Styling */
    .table-custom {
        margin-top: 24px;
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

    /* Force Dark Cells to prevent Bootstrap white-override */
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

    /* Style the AJAX generated Delete button seamlessly */
    .table-custom .deleteBtn {
        background-color: rgba(239, 68, 68, 0.1) !important;
        border: 1px solid rgba(239, 68, 68, 0.3) !important;
        color: #ef4444 !important;
        border-radius: 6px;
        padding: 6px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .table-custom .deleteBtn:hover {
        background-color: #ef4444 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    /* Modal Dark Theme Styling */
    .modal-content {
        background-color: #0f172a;
        border: 1px solid #1e2d4a;
        box-shadow: 0 15px 40px rgba(0,0,0,0.8);
    }

    .modal-header {
        border-bottom: 1px solid #1e2d4a;
    }

    .modal-title {
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .modal-footer {
        border-top: 1px solid #1e2d4a;
    }

    .form-label {
        color: #94a3b8;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        background-color: #131b2e;
        border: 1px solid #1e2d4a;
        color: #ffffff;
        border-radius: 8px;
        padding: 10px 16px;
    }

    .form-control:focus {
        background-color: #131b2e;
        border-color: #10b981;
        color: #ffffff;
        box-shadow: 0 0 12px rgba(16, 185, 129, 0.2);
    }
    
    .form-control::placeholder {
        color: #475569;
    }
</style>

<div class="container mt-4">
    <div class="dashboard-frame">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="section-title-tag">
                <h2>Course Management</h2>
                <p>Create, update, and manage academic programs</p>
            </div>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="bi bi-journal-plus me-2"></i> Add Course
            </button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <!-- FIXED HEADERS TO MATCH YOUR 7 DATA COLUMNS -->
                    <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Duration (Mos)</th>
                        <th>Fees</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="courseTableBody">
                    <!-- AJAX Data Populates Here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addCourseForm">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-journal-bookmark-fill me-2 text-success"></i>Add New Course</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <input type="hidden" name="action" value="add">
                    
                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" name="course_name" class="form-control" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course Code</label>
                            <input type="text" name="course_code" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duration (Months)</label>
                            <input type="number" name="duration" class="form-control"  required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Course Fees</label>
                        <input type="number" step="0.01" name="fees" class="form-control"  required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description / Category</label>
                        <textarea name="description" class="form-control" rows="2" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-add w-100">Save Course details</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadCourses() {
    $.ajax({
        url: 'ajax/courses_ajax.php', 
        type: 'POST',
        data: { action: 'fetch' },
        success: function(response) {
            $('#courseTableBody').html(response);
        }
    });
} 

$(document).ready(function(){
    loadCourses();

    $('#addCourseForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'ajax/courses_ajax.php', 
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
                
                if(response.trim() === 'success') {
                    $('#addCourseModal').modal('hide');
                    $('#addCourseForm')[0].reset();
                    loadCourses();
                } else {
                    alert(response);
                }
            }
        });
    });

    $(document).on('click', '.deleteBtn', function(){
        if(confirm("Are you sure you want to delete this course? All related enrollments will be lost.")) {
            var id = $(this).data('id');
            $.ajax({
                url: 'ajax/courses_ajax.php', 
                type: 'POST',
                data: { action: 'delete', id: id },
                success: function(){ loadCourses(); }
            });
        }
    });
}); 
</script>
<?php include 'includes/footer.php'; ?>