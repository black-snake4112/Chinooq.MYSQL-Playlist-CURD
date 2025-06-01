<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Artist</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="navbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">📚 View Artists</a>
    </nav>
</header>

<main class="main-content edit-box">
    <h1>🧾 Edit Artist</h1>
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
        $name = trim($_POST['name']);
        if (!empty($name)) {
            $updateStmt = $pdo->prepare("UPDATE artists SET Name = :name WHERE ArtistId = :id");
            $updateStmt->execute([':name' => $name, ':id' => $id]);
            echo "<p style='color:green;'>Artist updated successfully!</p>";
        } else {
            echo "<p class='error'>Name cannot be empty.</p>";
        }
    }
    ?>

    <form method="POST">
        <label for="name">Artist Name:</label>
        <input type="text" name="name" value="<?=htmlspecialchars($artist['Name'])?>" required>
        <button type="submit" class="button yellow">🔄 Update</button>
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
