<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    html,
    body {
        height: 100%;
        margin: 0;
        overflow-y: auto;
    }

    body {
        padding-left: 280px;
        background-color: #0f172a; 
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        height: 100vh;
        background-color: #070b14;
        display: flex;
        flex-direction: column;
        border-right: 1px solid #1e293b;
        z-index: 1000;
        font-family: 'Inter', sans-serif;
        transition: left 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .sidebar-brand {
        padding: 30px 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 10px;
    }

    .sidebar-brand h3 {
        color: #ffffff;
        font-weight: 800;
        margin: 0;
        font-size: 1.4rem;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .sidebar-brand span {
        color: #0ea5e9;
    }

    .sidebar-nav {
        flex-grow: 1;
        overflow-y: auto;
        padding: 10px 0;
    }

    .sidebar-nav::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: #1e293b;
        border-radius: 10px;
    }

    .nav-item-link {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        transition: all 0.2s ease;
        gap: 14px;
        margin: 4px 16px;
        border-radius: 8px;
    }

    .nav-item-link i {
        font-size: 1.2rem;
        opacity: 0.7;
    }

    .nav-item-link:hover {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.05);
    }

    .nav-item-link.active {
        background: linear-gradient(90deg, rgba(14, 165, 233, 0.15) 0%, transparent 100%);
        color: #ffffff;
        border-left: 3px solid #0ea5e9;
        border-radius: 0 8px 8px 0;
        margin-left: 0;
        padding-left: 33px;
    }

    .nav-item-link.active i {
        opacity: 1;
        color: #0ea5e9;
    }

    .sidebar-footer {
        padding: 20px 16px;
        background-color: #070b14;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .profile-card {
        background-color: #0f172a;
        border: 1px solid #1e293b;
        border-radius: 12px;
        padding: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .profile-avatar {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #0ea5e9;
    }

    .profile-info {
        overflow: hidden;
    }

    .profile-name {
        color: #ffffff;
        font-weight: 700;
        font-size: 0.9rem;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .profile-email {
        color: #64748b;
        font-size: 0.7rem;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .btn-logout {
        background-color: #334155;
        color: #f8fafc;
        border-radius: 12px;
        padding: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s ease;
        width: 100%;
        border: none;
        box-sizing: border-box;
    }

    .btn-logout:hover {
        background-color: #475569;
        color: #ffffff;
    }

    /* --- MOBILE MENU TOGGLE BUTTON --- */
    .mobile-menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        right: 20px; 
        z-index: 1001;
        background: #0ea5e9; 
        color: #ffffff;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        transition: background 0.3s ease;
    }
    
    .mobile-menu-toggle:hover {
        background: #0284c7;
    }

    /* --- RESPONSIVE CSS --- */
    @media screen and (max-width: 768px) {
        body {
            padding-left: 0 !important;
            padding-top: 60px !important; 
        }

        .mobile-menu-toggle {
            display: block !important;
        }

        .sidebar {
            left: -280px !important;
        }

        .sidebar.active {
            left: 0 !important;
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.7) !important; 
        }
    }
</style>

<button class="mobile-menu-toggle" id="menuToggle" aria-label="Toggle Menu">
    <i class="bi bi-list"></i>
</button>


<aside class="sidebar" id="trisul-sidebar">
    <!-- Brand Logo Area -->
    <div class="sidebar-brand">
        <h3>TRISUL <span>ACADEMY</span></h3>
    </div>

    <!-- Navigation Links -->
    <div class="sidebar-nav">
        <a href="admin_dashboard.php" class="nav-item-link <?= $currentPage == 'admin_dashboard.php' ? 'active' : '' ?>">
            <i class="bi bi-house"></i> Dashboard
        </a>
        <a href="students.php" class="nav-item-link <?= $currentPage == 'students.php' ? 'active' : '' ?>">
            <i class="bi bi-person"></i> Students
        </a>
        <a href="courses.php" class="nav-item-link <?= $currentPage == 'courses.php' ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-text"></i> Courses
        </a>
        <a href="enrollment.php" class="nav-item-link <?= $currentPage == 'enrollment.php' ? 'active' : '' ?>">
            <i class="bi bi-card-checklist"></i> Enrollments
        </a>
        <a href="reports.php" class="nav-item-link <?= $currentPage == 'reports.php' ? 'active' : '' ?>">
            <i class="bi bi-bar-chart"></i> Reports
        </a>
        <a href="manage_notices.php" class="nav-item-link <?= $currentPage == 'manage_notices.php' ? 'active' : '' ?>">
            <i class="bi bi-megaphone"></i> Manage Notices
        </a>
        <a href="search.php" class="nav-item-link <?= $currentPage == 'search.php' ? 'active' : '' ?>">
            <i class="bi bi-search"></i> Search & Sort
        </a>
        <a href="change_password.php" class="nav-item-link <?= $currentPage == 'change_password.php' ? 'active' : '' ?>">
            <i class="bi bi-shield-lock"></i> Change Password
        </a>
    </div>

    <div class="sidebar-footer">
        <div class="profile-card">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['admin_name'] ?? 'Admin') ?>&background=0ea5e9&color=fff&rounded=true&bold=true" alt="Avatar" class="profile-avatar">
            <div class="profile-info">
                <p class="profile-name"><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></p>
                <p class="profile-email"><?= htmlspecialchars($_SESSION['admin_email'] ?? 'admin@trisulacademy.com') ?></p>
            </div>
        </div>

        <a href="logout.php" class="btn-logout">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menuToggle');
        
        
        const sidebar = document.getElementById('trisul-sidebar'); 
        const icon = menuToggle ? menuToggle.querySelector('i') : null;

        if (menuToggle && sidebar) {
            menuToggle.addEventListener('click', function(event) {
                event.stopPropagation(); 
                sidebar.classList.toggle('active');

                if (sidebar.classList.contains('active')) {
                    icon.classList.remove('bi-list');
                    icon.classList.add('bi-x-lg');
                } else {
                    icon.classList.remove('bi-x-lg');
                    icon.classList.add('bi-list');
                }
            });
        }

        document.addEventListener('click', function(event) {
            if (sidebar && sidebar.classList.contains('active') && !sidebar.contains(event.target)) {
                sidebar.classList.remove('active');
                if (icon) {
                    icon.classList.remove('bi-x-lg');
                    icon.classList.add('bi-list');
                }
            }
        });
    });
</script>