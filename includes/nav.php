

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="admin_dashboard.php">SCMS Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="../dashboard/admin_dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../students.php">Students</a></li>
                <li class="nav-item"><a class="nav-link" href="../courses.php">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="../enrollment.php">Enrollments</a></li>
                <li class="nav-item"><a class="nav-link" href="../reports.php">Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="../search_sort.php">Search & Sort</a></li>
            </ul>
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><span class="nav-link text-white me-3">Welcome, <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></span></li>
                <li class="nav-item">
                    
                    <a class="btn btn-sm btn-outline-light me-2" href="../Authentication/change_password.php">Change Password</a>
                </li>
                <li class="nav-item">
                 
                    <a class="btn btn-sm btn-danger" href="../Authentication/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
