<?php
include '../config/dbcon.php';

if(isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['student_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $check = $pdo->prepare("SELECT id FROM students WHERE email = ?");
    $check->execute([$email]);
    if($check->rowCount() > 0) {
        die("Email is already registered. Please login.");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO students (student_name, email, password, phone, gender, dob, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password, $phone, $gender, $dob, $address]);
        echo "success";
    } catch(PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
}
?>