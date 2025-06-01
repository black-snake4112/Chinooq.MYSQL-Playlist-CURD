<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Album</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="navbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">📚 View Albums</a>
    </nav>
</header>

<main class="main-content delete-box">
    <h1>🗑️ Delete Album</h1>

    <?php
    $id = $_GET['id'] ?? null;
    if (!$id || !is_numeric($id)) {
        echo "<p class='error'>Invalid album ID.</p>";
        exit;
    }

    $stmt = $pdo->prepare("SELECT albums.AlbumId, albums.Title, artists.Name FROM albums JOIN artists ON albums.ArtistId = artists.ArtistId WHERE AlbumId = :id");
    $stmt->execute([':id' => $id]);
    $album = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$album) {
        echo "<p class='error'>Album not found.</p>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $deleteStmt = $pdo->prepare("DELETE FROM albums WHERE AlbumId = :id");
        $deleteStmt->execute([':id' => $id]);
        echo "<p style='color:green; font-weight:bold;'>Album deleted successfully!</p>";
        echo "<p><a href='read.php' class='button'>← Back to Albums</a></p>";
        exit;
    }
    ?>

    <p>Are you sure you want to delete the album "<strong><?=htmlspecialchars($album['Title'])?></strong>" by <strong><?=htmlspecialchars($album['Name'])?></strong>?</p>

    <form method="post" action="">
        <button type="submit" class="button button-danger">Yes, Delete</button>
        <a href="read.php" class="button button-secondary">Cancel</a>
    </form>
</main>

<footer class="footer extra-margin">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>

</body>
</html>
