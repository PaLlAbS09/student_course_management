<?php
include '../includes/auth_check.php';
include '../config/dbcon.php';

$action = $_POST['action'] ?? '';

if($action == 'fetch') {
    $stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
    $students = $stmt->fetchAll();
    foreach($students as $row) {
       echo "<tr>
        <td>" . htmlspecialchars($row['id']) . "</td>
        <td>" . htmlspecialchars($row['student_name']) . "</td>
        <td>" . htmlspecialchars($row['email']) . "</td>
        <td>" . htmlspecialchars($row['phone']) . "</td>
        <td>
            <button class='btn btn-danger btn-sm deleteBtn' data-id='" . htmlspecialchars($row['id']) . "'>Delete</button>
        </td>
      </tr>";
    }
}

if($action == 'add') {
    $name = $_POST['student_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

   $default_password = password_hash('password123', PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO students (student_name, email, password, phone, gender, dob, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $default_password, $phone, $gender, $dob, $address]);
        echo "success";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if($action == 'delete') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    echo "success";
}
?>