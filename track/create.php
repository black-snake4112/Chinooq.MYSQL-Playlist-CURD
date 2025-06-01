<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Track</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="navbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">🎼 View Tracks</a>
    </nav>
</header>

<main class="main-content form-box">
    <h1>➕ Add New Track</h1>

    <?php
    $albums = $pdo->query("SELECT AlbumId, Title FROM albums")->fetchAll();
    $genres = $pdo->query("SELECT GenreId, Name FROM genres")->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $albumId = $_POST['album_id'];
        $genreId = $_POST['genre_id'];

        if ($name && is_numeric($albumId) && is_numeric($genreId)) {
            $stmt = $pdo->prepare("INSERT INTO tracks (Name, AlbumId, GenreId) VALUES (:name, :album, :genre)");
            $stmt->execute([':name' => $name, ':album' => $albumId, ':genre' => $genreId]);
            header("Location: read.php");
            exit;
        } else {
            echo "<p class='error'>Please fill all fields correctly.</p>";
        }
    }
    ?>

    <form method="post">
        <label for="name">Track Name:</label>
        <input type="text" name="name" required>

        <label for="album_id">Album:</label>
        <select name="album_id" required>
            <option value="">-- Select Album --</option>
            <?php foreach ($albums as $album): ?>
                <option value="<?= $album['AlbumId'] ?>"><?= htmlspecialchars($album['Title']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="genre_id">Genre:</label>
        <select name="genre_id" required>
            <option value="">-- Select Genre --</option>
            <?php foreach ($genres as $genre): ?>
                <option value="<?= $genre['GenreId'] ?>"><?= htmlspecialchars($genre['Name']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="button green">Add Track</button>
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
