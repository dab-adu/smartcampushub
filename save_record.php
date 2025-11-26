<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['username']; 

    $sql = "INSERT INTO record_requests (request_id, user_id, record_type_id)
        VALUES (UUID(), ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$user_id, $record_type_id])) {
        header("Location: records.php?success=1");
        exit;
    } else {
        echo "Database Error";
    }
}
?>
