<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Track</title>
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

<main class="main-content edit-box">
    <h1>🧾 Edit Track</h1>

    <?php
    $id = $_GET['id'] ?? null;
    if (!$id || !is_numeric($id)) {
        echo "<p class='error'>Invalid track ID.</p>";
        exit;
    }

    $track = $pdo->prepare("SELECT * FROM tracks WHERE TrackId = :id");
    $track->execute([':id' => $id]);
    $track = $track->fetch();

    if (!$track) {
        echo "<p class='error'>Track not found.</p>";
        exit;
    }

    $albums = $pdo->query("SELECT AlbumId, Title FROM albums")->fetchAll();
    $genres = $pdo->query("SELECT GenreId, Name FROM genres")->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $albumId = $_POST['album_id'];
        $genreId = $_POST['genre_id'];

        if ($name && is_numeric($albumId) && is_numeric($genreId)) {
            $stmt = $pdo->prepare("UPDATE tracks SET Name = :name, AlbumId = :album, GenreId = :genre WHERE TrackId = :id");
            $stmt->execute([':name' => $name, ':album' => $albumId, ':genre' => $genreId, ':id' => $id]);
            header("Location: read.php");
            exit;
        } else {
            echo "<p class='error'>Please fill all fields correctly.</p>";
        }
    }
    ?>

    <form method="post">
        <label for="name">Track Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($track['Name']) ?>" required>

        <label for="album_id">Album:</label>
        <select name="album_id" required>
            <?php foreach ($albums as $album): ?>
                <option value="<?= $album['AlbumId'] ?>" <?= $album['AlbumId'] == $track['AlbumId'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($album['Title']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="genre_id">Genre:</label>
        <select name="genre_id" required>
            <?php foreach ($genres as $genre): ?>
                <option value="<?= $genre['GenreId'] ?>" <?= $genre['GenreId'] == $track['GenreId'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($genre['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="button yellow">Update Track</button>
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
