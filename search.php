<?php 
include 'includes/auth_check.php'; 
include 'includes/header.php'; 
include 'includes/nav.php';
?>
<div class="container mt-4">
    <h2>Search & Sort Students</h2>
    
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form id="searchSortForm" class="row align-items-end">
                
                <div class="col-md-5">
                    <label>Search (Name, Email, or Course)</label>
                    <input type="text" name="search_query" id="search_query" class="form-control" placeholder="Enter keyword...">
                </div>
                
             
                <div class="col-md-5">
                    <label>Sort By</label>
                    <select name="sort_by" id="sort_by" class="form-control">
                        <option value="s.student_name ASC">Student Name (A–Z)</option>
                        <option value="s.student_name DESC">Student Name (Z–A)</option>
                        <option value="c.course_name ASC">Course Name (A-Z)</option>
                        <option value="c.fees DESC">Highest Course Fee</option>
                        <option value="c.fees ASC">Lowest Course Fee</option>
                        <option value="e.enrollment_date DESC">Latest Enrollment</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Apply</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Student Name</th>
                <th>Email</th>
                <th>Course Name</th>
                <th>Fees</th>
                <th>Enrollment Date</th>
            </tr>
        </thead>
        <tbody id="searchResults">
           
        </tbody>
    </table>
</div>

<script>
function fetchResults() {
    $.ajax({
        url: 'ajax/search_sort_ajax.php',
        type: 'POST',
        data: $('#searchSortForm').serialize(),
        success: function(response) {
            $('#searchResults').html(response);
        }
    });
}

$(document).ready(function(){

    fetchResults();

    
    $('#searchSortForm').submit(function(e){
        e.preventDefault();
        fetchResults();
    });


    $('#search_query').keyup(function(){
        fetchResults();
    });
    $('#sort_by').change(function(){
        fetchResults();
    });
});
</script>
<?php include 'includes/footer.php'; ?>