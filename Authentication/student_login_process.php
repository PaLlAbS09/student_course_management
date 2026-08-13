<?php
session_start();
require '../config/dbcon.php'; 

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

  
    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->execute([$email]);
    $student = $stmt->fetch();

   
    if($student && password_verify($password, $student['password'])) {
       
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['student_name'];
        echo 'success';
    } else {
        echo 'Invalid Email or Password';
    }
} else {
    echo 'Please fill in all fields.';
}
?>