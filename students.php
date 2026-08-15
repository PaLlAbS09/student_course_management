<?php 
       include 'includes/auth_check.php'; 
       include 'includes/header.php';
       include 'includes/nav.php';
       include 'config/dbcon.php';
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
        background: linear-gradient(90deg, transparent, #00e5ff, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #00e5ff;
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

    /* Primary Action Button */
    .btn-add {
        background: linear-gradient(135deg, #00e5ff, #0284c7);
        border: none;
        color: #050505;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 10px 24px;
        border-radius: 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 229, 255, 0.3);
    }

    .btn-add:hover {
        background: linear-gradient(135deg, #0284c7, #00e5ff);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 229, 255, 0.5);
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
        background-color: #131b2e;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .table-custom tbody tr:hover {
        transform: translateY(-2px);
        background-color: #1a263d;
    }

    .table-custom tbody td {
        border: 1px solid #1e2d4a;
        border-style: solid none;
        padding: 16px;
        vertical-align: middle;
        
        font-size: 0.95rem;
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

    .form-control, .form-select {
        background-color: #131b2e;
        border: 1px solid #1e2d4a;
        color: #ffffff;
        border-radius: 8px;
        padding: 10px 16px;
    }

    .form-control:focus, .form-select:focus {
        background-color: #131b2e;
        border-color: #00e5ff;
        color: #ffffff;
        box-shadow: 0 0 12px rgba(0, 229, 255, 0.2);
    }
</style>

<div class="container mt-4">
    <div class="dashboard-frame">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="section-title-tag">
                <h2>Student Management</h2>
                <p>Register, view, and manage student accounts</p>
            </div>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                <i class="bi bi-person-plus-fill me-2"></i> Add Student
            </button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- AJAX Data Populates Here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="addStudentForm">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-person-badge me-2"></i>Add New Student</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="student_name" class="form-control"  required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="number" name="phone" class="form-control"  required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="" disabled selected>Select...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-add w-100">Save Student Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadStudents() {
    $.ajax({
        url: 'ajax/student_ajax.php',
        type: 'POST',
        data: { action: 'fetch' },
        success: function(response) {
            $('#studentTableBody').html(response);
        }
    });
}

$(document).ready(function(){
    loadStudents(); 

    $('#addStudentForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'ajax/student_ajax.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
              
                if(response.trim() === 'success') {
                    $('#addStudentModal').modal('hide');
                    $('#addStudentForm')[0].reset();
                    loadStudents();
                } else {
                    alert(response);
                }
            }
        });
    });

    // Delete Student
    $(document).on('click', '.deleteBtn', function(){
        if(confirm("Are you sure you want to delete this student record?")) {
            var id = $(this).data('id');
            $.ajax({
                url: 'ajax/student_ajax.php',
                type: 'POST',
                data: { action: 'delete', id: id },
                success: function(response){
                    loadStudents();
                }
            });
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>