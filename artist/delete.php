<?php
require_once '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    if ($id && is_numeric($id)) {
        $stmt = $pdo->prepare("DELETE FROM artists WHERE ArtistId = :id");
        $stmt->execute([':id' => $id]);
    }
}
header("Location: read.php");
exit;
