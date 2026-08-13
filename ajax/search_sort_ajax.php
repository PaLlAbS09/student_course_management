<?php
require '../includes/auth_check.php';
require '../config/dbcon.php'; 

$search = $_POST['search_query'] ?? '';
$sort = $_POST['sort_by'] ?? 's.student_name ASC';


$allowed_sorts = [
    's.student_name ASC', 
    's.student_name DESC', 
    'c.course_name ASC', 
    'c.fees DESC', 
    'c.fees ASC', 
    'e.enrollment_date DESC'
];

if (!in_array($sort, $allowed_sorts)) {
    $sort = 's.student_name ASC';
}

$query = "
    SELECT s.student_name, s.email, c.course_name, c.fees, e.enrollment_date 
    FROM students s
    LEFT JOIN enrollments e ON s.id = e.student_id
    LEFT JOIN courses c ON e.course_id = c.id
";

$params = [];
if (!empty($search)) {
    $query .= " WHERE s.student_name LIKE ? OR s.email LIKE ? OR c.course_name LIKE ?";
    $searchTerm = "%$search%";
    $params = [$searchTerm, $searchTerm, $searchTerm];
}

$query .= " ORDER BY " . $sort;

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $results = $stmt->fetchAll();

    if (count($results) > 0) {
        foreach($results as $row) {
            $course = $row['course_name'] ? htmlspecialchars($row['course_name']) : '<span class="text-muted">Not Enrolled</span>';
            $fees = $row['fees'] ? '$' . number_format($row['fees'], 2) : '-';
            $date = $row['enrollment_date'] ? htmlspecialchars($row['enrollment_date']) : '-';
            
            echo "<tr>
                    <td>" . htmlspecialchars($row['student_name']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>{$course}</td>
                    <td>{$fees}</td>
                    <td>{$date}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5' class='text-center'>No records found matching your criteria.</td></tr>";
    }
} catch(PDOException $e) {
    echo "<tr><td colspan='5' class='text-danger text-center'>Error loading data: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
}
?>