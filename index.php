<?php session_start(); 
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard/admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Course Management System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts for Cinematic Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;900&display=swap" rel="stylesheet">
    
    <!-- Internal CSS to guarantee rendering -->
    <style>
        
        body.cinematic-landing {
            background-color: #050505 !important;
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            color: #ffffff !important;
            position: relative;
            overflow: hidden;
            margin: 0;
            display: flex;
            align-items: center;
        }

    
        .cinematic-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            background-position: center center;
            box-shadow: inset 0 0 150px rgba(0, 0, 0, 0.9);
            z-index: 1;
            pointer-events: none;
        }

        .z-index-2 {
            z-index: 2;
            width: 100%;
        }

        
        .cinematic-subtitle {
            font-size: 0.85rem;
            font-weight: 300;
            letter-spacing: 8px;
            color: #888888;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

      
        .cinematic-title {
            font-size: 3.5rem;
            font-weight: 900;
            letter-spacing: 4px;
            color: #ffffff;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            text-shadow: 0 10px 20px rgba(0,0,0,0.5);
        }

      
        .title-divider {
            width: 60px;
            height: 4px;
            background-color: #ffffff;
            margin: 0 auto;
            border-radius: 2px;
        }

       
        .cinematic-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            min-height: 320px;
        }

        
        .cinematic-card:hover {
            transform: translateY(-8px);
            background: rgba(30, 30, 30, 0.9);
        }

        .admin-card:hover {
            border-color: #ff3366;
            box-shadow: 0 15px 35px rgba(255, 51, 102, 0.15);
        }

        .student-card:hover {
            border-color: #00e5ff;
            box-shadow: 0 15px 35px rgba(0, 229, 255, 0.15);
        }

        .cinematic-panel-title {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 2px;
            color: #ffffff;
        }

        .cinematic-text {
            font-weight: 300;
            font-size: 0.9rem;
            line-height: 1.7;
            color: #aaaaaa;
        }


        .cinematic-btn {
            border-radius: 0;
            font-weight: 700;
            letter-spacing: 2px;
            font-size: 0.85rem;
            text-transform: uppercase;
            padding: 12px 24px;
            background: transparent;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .admin-btn {
            color: #ff3366;
            border: 1px solid #ff3366;
        }

        .admin-btn:hover {
            background: #ff3366;
            color: #ffffff;
            box-shadow: 0 0 15px rgba(255, 51, 102, 0.4);
        }

        .student-btn {
            color: #00e5ff;
            border: 1px solid #00e5ff;
        }

        .student-btn:hover {
            background: #00e5ff;
            color: #050505;
            box-shadow: 0 0 15px rgba(0, 229, 255, 0.4);
        }
    </style>
</head>
<body class="cinematic-landing">

    <!-- Subtle Background Grid/Vignette -->
    <div class="cinematic-overlay"></div>

    <div class="container position-relative z-index-2">
        
        <!-- Main Title -->
        <div class="text-center mb-5 pb-3">
            <p class="cinematic-subtitle">SECURE ACCESS PORTAL</p>
            <h1 class="cinematic-title">COURSE MANAGEMENT</h1>
            <div class="title-divider"></div>
        </div>

        <!-- Cards Container -->
        <div class="row justify-content-center gap-4 px-3">
            
            <!-- Admin Panel Card -->
            <div class="col-md-5 col-lg-4 p-0">
                <div class="cinematic-card admin-card text-center p-5 d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="cinematic-panel-title">ADMINISTRATOR</h2>
                        <p class="cinematic-text mt-3">
                            System configuration, course operations, and analytical reporting.
                        </p>
                    </div>
                    <a href="./login.php" class="btn cinematic-btn admin-btn mt-4 w-100">INITIALIZE ADMIN</a>
                </div>
            </div>

            <!-- Student Panel Card -->
            <div class="col-md-5 col-lg-4 p-0">
                <div class="cinematic-card student-card text-center p-5 d-flex flex-column justify-content-between">
                    <div>
                        <h2 class="cinematic-panel-title">STUDENT</h2>
                        <p class="cinematic-text mt-3">
                            Academic records, enrollment tracking, and fee management.
                        </p>
                    </div>
                    <a href="./student_login.php" class="btn cinematic-btn student-btn mt-4 w-100">ACCESS PORTAL</a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>