<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Tracks</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="navbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="create.php" class="nav-link">➕ Add Track</a>
    </nav>
</header>

<main class="main-content">
    <h1>🎼 View All Tracks</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT tracks.TrackId, tracks.Name, albums.Title AS AlbumTitle, genres.Name AS GenreName
                FROM tracks 
                JOIN albums ON tracks.AlbumId = albums.AlbumId 
                JOIN genres ON tracks.GenreId = genres.GenreId";
        $stmt = $pdo->query($sql);
        while ($row = $stmt->fetch()) {
            echo "<tr>
                    <td>{$row['TrackId']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['AlbumTitle']}</td>
                    <td>{$row['GenreName']}</td>
                    <td>
                        <a href='update.php?id={$row['TrackId']}' class='button'>🧾 Edit</a>
                        <a href='confirm_delete.php?id={$row['TrackId']}' class='button button-danger'>❌ Delete</a>
                    </td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
</main>

<!-- Code for footer at the bottom -->
<footer class="footer">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>
</body>
</html>
