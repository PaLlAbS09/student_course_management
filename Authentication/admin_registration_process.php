<?php
include '../config/dbcon.php'; 

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    
 
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];


    if (empty($name) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    try {
        
        $check_stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check_stmt->execute([$email]);
        
        if ($check_stmt->rowCount() > 0) {
            die("An administrator with this email is already registered.");
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
        $insert_stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        
        if ($insert_stmt->execute([$name, $email, $hashed_password])) {
            echo "success";
        } else {
            echo "Error: Could not register admin. Please try again.";
        }

    } catch (PDOException $e) {
        
        echo "Database Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>