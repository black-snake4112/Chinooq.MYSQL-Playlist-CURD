<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Delete Album</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>


<!-- code for navbar (top of header section or top of the page) added navlinks for Home and View Albums -->

<header class="navigationbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">📚 View Albums</a>
    </nav>
</header>

<!-- code for the blocks/container where Delete section exists -->

<main class="Focus-Section delete-box">
    <h1>🚫 Delete Album</h1>
 
    <!-- below this it gets the album id from the url and check if it is available and is a number otherwise declare the error invalid album id -->
    <?php
    $id = $_GET['id'] ?? null;
    if (!$id || !is_numeric($id)) { echo "<p class='error'>Invalid or unknown album ID.</p>"; exit;}

    

    // it is a query to get the album id otherwise show an error something went wrong album not found

    $stmt = $pdo->prepare("SELECT albums.AlbumId, albums.Title, artists.Name FROM albums JOIN artists ON albums.ArtistId = artists.ArtistId WHERE AlbumId = :id");
    $stmt->execute([':id' => $id]);
    $album = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$album) {  echo "<p class='error'>Something went wrong album not found.</p>";exit;}




    // its a POST request or the user can go back in the previous section along with inline CSS
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {$deleteStmt = $pdo->prepare("DELETE FROM albums WHERE AlbumId = :id");
        $deleteStmt->execute([':id' => $id]);
        echo "<p style='color:green; font-weight:bold;'>your album deleted successfully!</p>";
        echo "<p><a href='read.php' class='button'>← Back to albums</a></p>"; exit;}?>




    <p>Are you sure you want to delete the album "<strong><?=htmlspecialchars($album['Title'])?></strong>" by <strong><?=htmlspecialchars($album['Name'])?></strong>?</p>




    <!-- buttons OK, delete        abort(cancel) for delete confirmation -->
    <form method="post" action="">
        <button type="submit" class="button button-danger">OK, Delete</button>
        <a href="read.php" class="button button-secondary">Abort(cancel)</a>
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
