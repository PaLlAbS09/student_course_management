<?php
session_start();
include '../config/dbcon.php';

if(isset($_SESSION['student_id'])) {
    $stmt = $pdo->prepare("UPDATE students SET student_name=?, phone=?, dob=?, address=? WHERE id=?");
    if($stmt->execute([$_POST['student_name'], $_POST['phone'], $_POST['dob'], $_POST['address'], $_SESSION['student_id']])) {
        
        $_SESSION['student_name'] = $_POST['student_name'];
        echo 'success';
    } else {
        echo 'error';
    }
}
?>