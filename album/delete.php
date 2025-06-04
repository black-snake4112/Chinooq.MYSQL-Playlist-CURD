<?php
require_once '../db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the DELETE statement
    $stmt = $pdo->prepare("DELETE FROM albums WHERE AlbumId = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "You deleted Album Successfully.";} else { echo "Deleting Album Failed.";}} else {echo "Invalid/unknown album ID.";}?>

<!-- Code for footer at the bottom -->
<footer class="footer">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>