<?php
include '../includes/auth_check.php';
include '../config/dbcon.php';

$action = $_POST['action'] ?? '';

if($action == 'fetch') {
    $stmt = $pdo->query("SELECT * FROM courses ORDER BY id DESC");
    while($row = $stmt->fetch()) {
       echo "<tr>
        <td>" . htmlspecialchars($row['id']) . "</td>
        <td>" . htmlspecialchars($row['course_name']) . "</td>
        <td>" . htmlspecialchars($row['course_code']) . "</td>
        <td>" . htmlspecialchars($row['duration']) . "</td>
        <td>" . htmlspecialchars($row['fees']) . "</td>
        <td>" . htmlspecialchars($row['description']) . "</td>
        <td>
            <button class='btn btn-danger btn-sm deleteBtn' data-id='" . htmlspecialchars($row['id']) . "'>Delete</button>
        </td>
      </tr>";
    }
}

if($action == 'add') {
    $name = $_POST['course_name'];
    $code = $_POST['course_code'];
    $duration = $_POST['duration'];
    $fees = $_POST['fees'];
    $desc = $_POST['description'];

    // Validation
    if($duration <= 0 || $fees <= 0) {
        die("Duration and Fees must be greater than zero.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO courses (course_name, course_code, duration, fees, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $code, $duration, $fees, $desc]);
        echo "success";
    } catch(PDOException $e) {
        echo "Database Error. Course Code might already exist.";
    }
}

if($action == 'delete') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->execute([$id]);
}
?>