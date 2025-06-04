<?php
// connection to the database file chinook
require_once '../db.php';

// its a post method to check id from database and than prepare the SQL query to delete the following track
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id && is_numeric($id)) {
        $stmt = $pdo->prepare("DELETE FROM tracks WHERE TrackId = :id");
        $stmt->execute([':id' => $id]);}}

        // redirect the user to the read.php page after deletion
header("Location: read.php");exit;
