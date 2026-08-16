<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$inDashboard = (basename(dirname($_SERVER['PHP_SELF'])) === 'dashboard');
$base = $inDashboard ? '../' : './';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    body {
        padding-left: 280px;
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
        font-size: 1.3rem; 
        letter-spacing: 1px;
        text-transform: uppercase;
        white-space: nowrap; 
    }

    .sidebar-brand span {
        color: #00e5ff;
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
        background: linear-gradient(90deg, rgba(0, 229, 255, 0.15) 0%, transparent 100%);
        color: #ffffff;
        border-left: 3px solid #00e5ff;
        border-radius: 0 8px 8px 0;
        margin-left: 0;
        padding-left: 33px;
    }

    .nav-item-link.active i {
        opacity: 1;
        color: #00e5ff;
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
        padding: 12px 14px;
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 16px;
    }

    .profile-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 2px solid #00e5ff; 
        padding: 2px; 
        background-color: #070b14;
        flex-shrink: 0;
    }

    .profile-info {
        overflow: hidden;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .profile-name {
        color: #ffffff;
        font-weight: 700;
        font-size: 0.9rem;
        margin: 0;
        line-height: 1.2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .profile-email {
        color: #64748b;
        font-size: 0.75rem;
        margin: 4px 0 0 0;
        line-height: 1.2;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .btn-logout {
        background-color: #1e202c;
        color: #ef4444;
        border-radius: 12px;
        padding: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-logout:hover {
        background-color: #ef4444;
        color: #ffffff;
    }

    /* --- MOBILE MENU TOGGLE BUTTON --- */
    .mobile-menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        right: 20px; 
        z-index: 1001;
        background: #00e5ff; 
        color: #050505;
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
        color: #fff;
    }

    /* --- RESPONSIVE SIDEBAR CSS --- */
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

    /* ---  320px  --- */
    @media screen and (max-width: 576px) {
      
        .dashboard-frame {
            padding: 15px !important;
            margin-top: 10px !important;
        }

       
        .table-custom tbody td, .table-custom thead th {
            white-space: nowrap;
        }

      
        .section-title-tag h2 {
            font-size: 1.15rem !important;
        }

       
        .finance-card, .profile-card, .security-card, .support-form {
            padding: 15px !important;
        }

        .profile-avatar {
            width: 40px !important;
            height: 40px !important;
        }
        .fee-highlight-box {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 5px;
        }

        
        .avatar-large {
            width: 70px !important;
            height: 70px !important;
        }
    }
</style>

<!-- Hamburger Button -->
<button class="mobile-menu-toggle" id="studentMenuToggle" aria-label="Toggle Menu">
    <i class="bi bi-list"></i>
</button>

<!-- Sidebar -->
<aside class="sidebar" id="student-sidebar">
    <div class="sidebar-brand">
        <h3>TRISUL <span>ACADEMY</span></h3>
    </div>
    <div class="sidebar-nav">
     
        <a href="<?= $base ?>dashboard/student_dashboard.php" class="nav-item-link <?= $currentPage == 'student_dashboard.php' ? 'active' : '' ?>">
            <i class="bi bi-mortarboard"></i> My Courses
        </a>
        <a href="<?= $base ?>student_payments.php" class="nav-item-link <?= $currentPage == 'student_payments.php' ? 'active' : '' ?>">
            <i class="bi bi-wallet2"></i> Payment History
        </a>
        <a href="<?= $base ?>student_support.php" class="nav-item-link <?= $currentPage == 'student_support.php' ? 'active' : '' ?>">
            <i class="bi bi-megaphone"></i> Notices & Support
        </a>
        <a href="<?= $base ?>student_profile.php" class="nav-item-link <?= $currentPage == 'student_profile.php' ? 'active' : '' ?>">
            <i class="bi bi-person-gear"></i> My Profile
        </a>
    </div>
    <div class="sidebar-footer">
        
        <!-- Corrected Profile Card -->
        <div class="profile-card">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['student_name'] ?? 'Student') ?>&background=00e5ff&color=000&rounded=true&bold=true" alt="Avatar" class="profile-avatar">
            <div class="profile-info">
                <p class="profile-name"><?= htmlspecialchars($_SESSION['student_name'] ?? 'Student') ?></p>
                <p class="profile-email"><?= htmlspecialchars($_SESSION['student_email'] ?? 'student@academy.com') ?></p>
            </div>
        </div>

        <a href="<?= $base ?>Authentication/student_logout.php" class="btn-logout">
            <i class="bi bi-box-arrow-left"></i> Logout
        </a>
    </div>
</aside>

<!-- Hamburger Menu -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('studentMenuToggle');
        const sidebar = document.getElementById('student-sidebar'); 
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