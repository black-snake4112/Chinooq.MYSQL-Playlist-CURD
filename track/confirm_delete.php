<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Confirm Delete Track</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- code for navbar (top of header section or top of the page) -->
<header class="navigationbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">🎼 View Tracks</a>
    </nav>
</header>

<main class="Focus-Section delete-box">
    <h1>🚫 Delete Track</h1>

    <?php
    $id = $_GET['id'] ?? null;
    if (!$id || !is_numeric($id)) {
        echo "<p class='error'>Invalid track ID.</p>";
        exit;
    }

    $stmt = $pdo->prepare("SELECT tracks.Name, albums.Title FROM tracks JOIN albums ON tracks.AlbumId = albums.AlbumId WHERE TrackId = :id");
    $stmt->execute([':id' => $id]);
    $track = $stmt->fetch();

    if (!$track) {
        echo "<p class='error'>Track not found.</p>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $delete = $pdo->prepare("DELETE FROM tracks WHERE TrackId = :id");
        $delete->execute([':id' => $id]);
        echo "<p style='color:green; font-weight:bold;'>Track deleted successfully!</p>";
        echo "<p><a href='read.php' class='button'>← Back to Tracks</a></p>";
        exit;
    }
    ?>

    <p>Are you sure you want to delete the track "<strong><?= htmlspecialchars($track['Name']) ?></strong>" from the album <strong><?= htmlspecialchars($track['Title']) ?></strong>?</p>

    <form method="post" action="">
        <button type="submit" class="button button-danger">Yes, Delete</button>
        <a href="read.php" class="button button-secondary">Cancel</a>
    </form>
</main>

<!-- Code for footer at the bottom -->
<footer class="footer">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>

</body>
</html>
