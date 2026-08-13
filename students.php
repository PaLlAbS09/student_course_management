<?php 
       include 'includes/auth_check.php'; 
       include 'includes/header.php';
       include 'includes/nav.php';
       
    
       include 'config/dbcon.php';
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Student Management</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
    </div>
    <table class="table table-bordered">
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
        </tbody>
    </table>
</div>

<div class="modal fade" id="addStudentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addStudentForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3"><label>Name</label><input type="text" name="student_name" class="form-control" required></div>
                    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>Phone</label><input type="number" name="phone" class="form-control" required></div>
                    <div class="mb-3"><label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male">Male</option><option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3"><label>Date of Birth</label><input type="date" name="dob" class="form-control" required></div>
                    <div class="mb-3"><label>Address</label><textarea name="address" class="form-control" required></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Student</button>
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
                if(response == 'success') {
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
        if(confirm("Are you sure?")) {
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
<?php require 'includes/footer.php'; ?>