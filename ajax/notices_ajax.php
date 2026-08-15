<?php
session_start();
include '../config/dbcon.php';

if(!isset($_SESSION['admin_id'])) {
    die("Unauthorized");
}

$action = $_POST['action'] ?? '';

// FETCH NOTICES
if($action == 'fetch') {
    $stmt = $pdo->query("SELECT * FROM notices ORDER BY date_posted DESC");
    $notices = $stmt->fetchAll();
    
    if(count($notices) > 0) {
        foreach($notices as $row) {
            $formatted_date = date('d M Y', strtotime($row['date_posted']));
            
            $body_preview = strlen($row['body']) > 60 ? substr(htmlspecialchars($row['body']), 0, 60) . '...' : htmlspecialchars($row['body']);
            
            echo "<tr>
                    <td><span class='notice-date-badge'>{$formatted_date}</span></td>
                    <td class='fw-bold text-white'>" . htmlspecialchars($row['title']) . "</td>
                    <td class='text-muted small'>{$body_preview}</td>
                    <td><button class='deleteBtn' data-id='{$row['id']}'><i class='bi bi-trash3-fill'></i></button></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4' class='text-center text-muted py-4'>No notices published yet.</td></tr>";
    }
}

// ADD NOTICE
if($action == 'add') {
    $title = trim($_POST['title']);
    $body = trim($_POST['body']);
    
    if(!empty($title) && !empty($body)) {
        $stmt = $pdo->prepare("INSERT INTO notices (title, body, date_posted) VALUES (?, ?, CURDATE())");
        if($stmt->execute([$title, $body])) {
            echo "success";
        } else {
            echo "error";
        }
    }
}

// DELETE NOTICE
if($action == 'delete') {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM notices WHERE id = ?");
    $stmt->execute([$id]);
    echo "success";
}
?>