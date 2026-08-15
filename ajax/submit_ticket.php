<?php
session_start();
include '../config/dbcon.php';


if(isset($_SESSION['student_id'])) {
    
    $student_id = $_SESSION['student_id'];
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if(!empty($subject) && !empty($message)) {
        
       
        $stmt = $pdo->prepare("INSERT INTO support_tickets (student_id, subject, message) VALUES (?, ?, ?)");
        
        if($stmt->execute([$student_id, $subject, $message])) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'empty_fields';
    }
} else {
    echo 'unauthorized';
}
?>