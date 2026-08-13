<?php
session_start();
include '../config/dbcon.php'; 

if(!isset($_SESSION['admin_id'])) {
    die("Unauthorized access.");
}

if(isset($_POST['current_password']) && isset($_POST['new_password'])) {
    $admin_id = $_SESSION['admin_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$admin_id]);
    $user = $stmt->fetch();

   
    if(password_verify($current_password, $user['password'])) {
        
      
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
       
        $update_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        if($update_stmt->execute([$new_hashed_password, $admin_id])) {
            echo 'success';
        } else {
            echo 'Error updating password. Please try again.';
        }
    } else {
        echo 'Incorrect current password.';
    }
} else {
    echo 'Please fill in all fields.';
}
?>