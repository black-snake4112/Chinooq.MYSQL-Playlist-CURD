<!-- update.php -->
<?php require_once '../db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Album</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>

<header class="navbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">📚 View Albums</a>
    </nav>
</header>

<main class="main-content edit-box">
    <h1>✏️ Edit Album</h1>

    <?php
    $errors = [];
    $success = false;

    $id = $_GET['id'] ?? null;    
    if (!$id || !is_numeric($id)) {
        echo "<p class='alert alert-error'>Invalid album ID.</p>";
        exit;
    }

    // Load album data
    $stmt = $pdo->prepare("SELECT * FROM albums WHERE AlbumId = :id");
    $stmt->execute([':id' => $id]);
    $album = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$album) {
        echo "<p class='alert alert-error'>Album not found.</p>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title'] ?? '');
        $artistId = $_POST['artist'] ?? '';

        if (empty($title)) {
            $errors[] = "Album title is required.";
        }
        if (empty($artistId) || !is_numeric($artistId)) {
            $errors[] = "Valid artist must be selected.";
        }

        if (empty($errors)) {
            $updateStmt = $pdo->prepare("UPDATE albums SET Title = :title, ArtistId = :artistId WHERE AlbumId = :id");
            $updateStmt->execute([
                ':title' => $title,
                ':artistId' => $artistId,
                ':id' => $id
            ]);
            $success = true;

            // Reload album to show updated data in form
            $stmt = $pdo->prepare("SELECT * FROM albums WHERE AlbumId = :id");
            $stmt->execute([':id' => $id]);
            $album = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    // Get artist list for dropdown
    $artists = $pdo->query("SELECT ArtistId, Name FROM artists ORDER BY Name")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Show error alert if errors exist -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Show success alert -->
    <?php if ($success): ?>
        <div class="alert alert-success">
            Album updated successfully!
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="title">Album Title:</label>
        <input type="text" id="title" name="title" 
               value="<?= htmlspecialchars($_POST['title'] ?? $album['Title']) ?>" required />

        <label for="artist">Artist:</label>
        <select id="artist" name="artist" required>
            <option value="">-- Select Artist --</option>
            <?php foreach ($artists as $artist): ?>
                <option value="<?= $artist['ArtistId'] ?>" 
                    <?= ((isset($_POST['artist']) && $_POST['artist'] == $artist['ArtistId']) 
                        || (!isset($_POST['artist']) && $album['ArtistId'] == $artist['ArtistId'])) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($artist['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="button yellow">Update Album</button>
    </form>
</main>

<footer class="footer">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>

</body>
</html>
