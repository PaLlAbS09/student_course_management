<?php 
include 'includes/auth_check.php'; 
include 'includes/header.php'; 
include 'includes/nav.php';
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Course Management</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add Course</button>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Course Name</th>
                <th>Duration (Months)</th>
                <th>Fees ($)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="courseTableBody">
        </tbody>
    </table>
</div>

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addCourseForm">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3"><label>Course Name</label><input type="text" name="course_name" class="form-control" required></div>
                    <div class="mb-3"><label>Course Code</label><input type="text" name="course_code" class="form-control" required></div>
                    <div class="mb-3"><label>Duration (Months)</label><input type="number" name="duration" class="form-control" min="1" required></div>
                    <div class="mb-3"><label>Fees</label><input type="number" step="0.01" name="fees" class="form-control" min="1" required></div>
                    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Course</button>
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
        if(confirm("Delete this course? All related enrollments will be lost.")) {
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