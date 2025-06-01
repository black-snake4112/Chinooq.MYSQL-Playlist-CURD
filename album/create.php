<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add New Album</title>
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

<main class="main-content form-box">
    <h1>➕ Add New Album ➕</h1>

    <?php
    $errors = [];
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
            $stmt = $pdo->prepare("INSERT INTO albums (Title, ArtistId) VALUES (:title, :artistId)");
            $stmt->execute([':title' => $title, ':artistId' => $artistId]);
            echo "<p style='color:green; font-weight:bold;'>Album added successfully!</p>";
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
        <input type="text" id="title" name="title" value="<?=htmlspecialchars($_POST['title'] ?? '')?>" required />

        <label for="artist">Artist:</label>
        <select id="artist" name="artist" required>
            <option value="">-- Select Artist --</option>
            <?php foreach ($artists as $artist): ?>
                <option value="<?=$artist['ArtistId']?>" <?= (isset($_POST['artist']) && $_POST['artist'] == $artist['ArtistId']) ? 'selected' : '' ?>>
                    <?=htmlspecialchars($artist['Name'])?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="button green">Add Album</button>
    </form>
</main>
 
<footer class="footer">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>

</body>
</html>
