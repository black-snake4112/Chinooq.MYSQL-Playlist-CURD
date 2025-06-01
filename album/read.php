<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Albums</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="navbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="create.php" class="nav-link">➕ Add Album</a>
    </nav>
</header>

<main class="main-content">
    <h1>📚 View All Albums</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Artist</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT albums.AlbumId, albums.Title, artists.Name 
                    FROM albums 
                    JOIN artists ON albums.ArtistId = artists.ArtistId";
            $stmt = $pdo->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['AlbumId']}</td>
                        <td>{$row['Title']}</td>
                        <td>{$row['Name']}</td>
                        <td>
                            <a href='update.php?id={$row['AlbumId']}' class='button'>✏️ Edit</a>
                            <a href='confirm_delete.php?id={$row['AlbumId']}' class='button button-danger'>🗑️ Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<footer class="footer">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>

</body>
</html>
