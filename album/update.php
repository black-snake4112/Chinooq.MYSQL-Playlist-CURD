
 <?php require_once '../db.php'; ?>  
 
 <!-- database connection to file db.php -->

 <!-- simple html structure -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Album</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<!-- code for the navigation bar  -->
<header class="navbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">📚 View Albums</a>
    </nav>
</header>


<!-- code for the blocks/container where update/edit section exists -->
<main class="main-content edit-box">
    <h1>✏️ Edit Album</h1>

    <?php

    //  Gets the album id from chinook database 
    $errors = [];
    $id = $_GET['id'] ?? null;    
    if (!$id || !is_numeric($id)) {
        echo "<p class='error'>Invalid album ID.</p>";
        exit;}
//Loads the album with id from chinook database

    $stmt = $pdo->prepare("SELECT * FROM albums WHERE AlbumId = :id");
    $stmt->execute([':id' => $id]);
    $album = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$album) {
        echo "<p class='error'>Album not found.</p>";
        exit;
    }
// handling form submission POST request

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
            echo "<p style='color:green; font-weight:bold;'>Album updated successfully!</p>";
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


    <!-- HTML Form -->

    <form method="post" action="">
        <label for="title">Album Title:</label>
        <input type="text" id="title" name="title" value="<?=htmlspecialchars($_POST['title'] ?? $album['Title'])?>" required />

        <label for="artist">Artist:</label>
        <select id="artist" name="artist" required>
            <option value="">-- Select Artist --</option>
            <?php foreach ($artists as $artist): ?>
                <option value="<?=$artist['ArtistId']?>" <?= ((isset($_POST['artist']) && $_POST['artist'] == $artist['ArtistId']) || (!isset($_POST['artist']) && $album['ArtistId'] == $artist['ArtistId'])) ? 'selected' : '' ?>>
                    <?=htmlspecialchars($artist['Name'])?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="button yellow">Update Album</button>
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
