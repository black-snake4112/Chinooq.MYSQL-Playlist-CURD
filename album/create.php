<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add New Album</title>
    <link rel="stylesheet" href="../css/style.css" />
    <style>
        .track-group { margin-bottom: 15px; }
    </style>
</head>
<body>

<header class="navbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">📚 View Albums</a>
        <a href="../artist/create.php" class="nav-link">🎤 Add Artist</a>
        <a href="../track/create.php" class="nav-link">🎼 Add Track</a>
    </nav>
</header>

<main class="main-content form-box">
    <h1>➕ Add Album & Artist</h1>

    <?php
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title'] ?? '');
        $artistId = $_POST['artist'] ?? '';
        $newArtist = trim($_POST['new_artist'] ?? '');

        if (!$title) $errors[] = "Album title is required.";
        if (!$artistId && !$newArtist) $errors[] = "Select an artist or add a new one.";

        if (empty($errors)) {
            // Add new artist if provided
            if ($newArtist) {
                $stmt = $pdo->prepare("INSERT INTO artists (Name) VALUES (:name)");
                $stmt->execute([':name' => $newArtist]);
                $artistId = $pdo->lastInsertId();
            }

            // Add album
            $stmt = $pdo->prepare("INSERT INTO albums (Title, ArtistId) VALUES (:title, :artistId)");
            $stmt->execute([':title' => $title, ':artistId' => $artistId]);

            echo "<p style='color:green;'>Album and artist added successfully!</p>";
            echo "<p><a href='read.php' class='button'>← Back to Albums</a></p>";
            exit;
        }
    }

    $artists = $pdo->query("SELECT ArtistId, Name FROM artists ORDER BY Name")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php if ($errors): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?=htmlspecialchars($err)?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="title">Album Title:</label>
        <input type="text" id="title" name="title" required value="<?=htmlspecialchars($_POST['title'] ?? '')?>">

        <label for="artist">Select Existing Artist:</label>
        <select name="artist" id="artist">
            <option value="">-- Select Artist --</option>
            <?php foreach ($artists as $a): ?>
                <option value="<?= $a['ArtistId'] ?>" <?= ($_POST['artist'] ?? '') == $a['ArtistId'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($a['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="new_artist">Or Add New Artist:</label>
        <input type="text" id="new_artist" name="new_artist" placeholder="New Artist Name" value="<?=htmlspecialchars($_POST['new_artist'] ?? '')?>">

        <br><br>
        <button type="submit" class="button green">Save</button>
    </form>
</main>

<footer class="footer">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>

</body>
</html>
