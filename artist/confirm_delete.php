<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Artist</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- code for navbar (top of header section or top of the page) -->
<header class="navigationbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">📚 View Artists</a>
    </nav>
</header>

<main class="Focus-Section delete-box">
    <h1>🚫 Delete Artist</h1>
    <?php
    $id = $_GET['id'] ?? null;
    if (!$id || !is_numeric($id)) {
        echo "<p class='error'>Invalid ID.</p>";
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM artists WHERE ArtistId = :id");
    $stmt->execute([':id' => $id]);
    $artist = $stmt->fetch();

    if (!$artist) {
        echo "<p class='error'>Artist not found.</p>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pdo->prepare("DELETE FROM artists WHERE ArtistId = :id")->execute([':id' => $id]);
        echo "<p style='color:green;'>Artist deleted successfully.</p><a href='read.php' class='button'>← Back to Artists</a>";
        exit;
    }
    ?>
    <p>Are you sure you want to delete the artist <strong><?=htmlspecialchars($artist['Name'])?></strong>?</p>
    <form method="POST">
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
