<?php 
include 'includes/auth_check.php'; 
include 'includes/header.php'; 
include 'includes/nav.php';
?>


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
        background: linear-gradient(90deg, transparent, #0ea5e9, transparent);
    }

    .section-title-tag {
        border-left: 3px solid #0ea5e9;
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
        border-color: #0ea5e9;
        color: #ffffff;
        box-shadow: 0 0 12px rgba(14, 165, 233, 0.2);
    }

    .form-control::placeholder {
        color: #475569;
    }

    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    }

  
    .btn-search {
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        border: none;
        color: #ffffff;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 0 20px;
        border-radius: 8px;
        text-transform: uppercase;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-search:hover {
        background: linear-gradient(135deg, #0284c7, #0369a1);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.5);
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
</style>

<div class="container mt-4">
    <div class="dashboard-frame">
        
        <div class="section-title-tag">
            <h2>Search & Sort Directory</h2>
            <p>Filter, find, and organize student records</p>
        </div>
        
      
        <div class="form-box">
            <form id="searchSortForm" class="row align-items-end g-3">
                
                <div class="col-md-5">
                    <label class="form-label"><i class="bi bi-search me-2"></i>Keyword Search</label>
                    <input type="text" name="search_query" id="search_query" class="form-control" placeholder="Search Name, Email, or Course...">
                </div>
                
                <div class="col-md-5">
                    <label class="form-label"><i class="bi bi-sort-down me-2"></i>Sort Results By</label>
                    <select name="sort_by" id="sort_by" class="form-select">
                        <option value="s.student_name ASC">Student Name (A–Z)</option>
                        <option value="s.student_name DESC">Student Name (Z–A)</option>
                        <option value="c.course_name ASC">Course Name (A-Z)</option>
                        <option value="c.fees DESC">Highest Course Fee</option>
                        <option value="c.fees ASC">Lowest Course Fee</option>
                        <option value="e.enrollment_date DESC">Latest Enrollment</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <button type="submit" class="btn btn-search w-100">Apply Filter</button>
                </div>
            </form>
        </div>

        
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Course Name</th>
                        <th>Fees</th>
                        <th>Enrollment Date</th>
                    </tr>
                </thead>
                <tbody id="searchResults">
                    <!-- AJAX Data Populates Here -->
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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