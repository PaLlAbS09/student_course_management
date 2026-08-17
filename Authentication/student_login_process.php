<?php
session_start();
include '../config/dbcon.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        
        $email = trim($_POST['email']);
        $password = $_POST['password'];

      
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid Email or Password';
            exit;
        }

    
        try {
            $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?");
            $stmt->execute([$email]);
            $student = $stmt->fetch();

            if ($student && password_verify($password, $student['password'])) {
                
                
                session_regenerate_id(true);
                
                $_SESSION['student_id'] = $student['id'];
                $_SESSION['student_name'] = $student['student_name'];
                
                echo 'success';
            } else {
                echo 'Invalid Email or Password';
            }
        } catch (PDOException $e) {
             
            echo 'A system error occurred. Please try again later.';
        }

    } else {
        echo 'Please fill in all fields.';
    }
} else {
   
    echo 'Invalid request method.';
}
?>