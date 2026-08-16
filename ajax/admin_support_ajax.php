<?php

session_start();
include '../config/dbcon.php';

if (!isset($_SESSION['admin_id'])) {
    echo "Unauthorized";
    exit;
}

$action = $_POST['action'] ?? '';

if ($action == 'update_status') {
    $ticket_id = $_POST['ticket_id'] ?? '';
    $status = $_POST['status'] ?? ''; 

    if (!empty($ticket_id) && in_array($status, ['Approved', 'Rejected'])) {
        try {
            $stmt = $pdo->prepare("UPDATE support_tickets SET status = ? WHERE id = ?");
            if ($stmt->execute([$status, $ticket_id])) {
                echo 'success';
            } else {
                echo 'Failed to update database.';
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid parameters provided.";
    }
}
?>