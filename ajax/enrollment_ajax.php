<?php
include '../includes/auth_check.php';
include '../config/dbcon.php';

$action = $_POST['action'] ?? '';

if($action == 'fetch') {
    
    $query = "SELECT e.id, s.student_name, c.course_name, e.enrollment_date 
              FROM enrollments e 
              INNER JOIN students s ON e.student_id = s.id 
              INNER JOIN courses c ON e.course_id = c.id 
              ORDER BY e.id DESC";
              
    $stmt = $pdo->query($query);
    while($row = $stmt->fetch()) {
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

if($action == 'enroll') {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $date = $_POST['enrollment_date'];

   
    $check = $pdo->prepare("SELECT id FROM enrollments WHERE student_id = ? AND course_id = ?");
    $check->execute([$student_id, $course_id]);
    
    if($check->rowCount() > 0) {
        die("Error: Student is already enrolled in this course.");
    }

    $stmt = $pdo->prepare("INSERT INTO enrollments (student_id, course_id, enrollment_date) VALUES (?, ?, ?)");
    $stmt->execute([$student_id, $course_id, $date]);
    echo "success";
}

if($action == 'delete') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM enrollments WHERE id = ?");
    $stmt->execute([$id]);
}
?>