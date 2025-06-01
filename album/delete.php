<?php
require_once '../db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the DELETE statement
    $stmt = $pdo->prepare("DELETE FROM albums WHERE AlbumId = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Album deleted successfully.";
    } else {
        echo "Error deleting album.";
    }
} else {
    echo "Invalid album ID.";
}
?>
