<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Explore Artists</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- code for navbar (top of header section or top of the page) -->
<header class="navigationbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="create.php" class="nav-link">➕ Add Artist</a>
    </nav>
</header>

<main class="Focus-Section">
    <h1>🎤 View All Artists</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("SELECT * FROM artists ORDER BY Name ASC");
            while ($row = $stmt->fetch()) {
                echo "<tr>
                    <td>{$row['ArtistId']}</td>
                    <td>{$row['Name']}</td>
                    <td>
                        <a href='update.php?id={$row['ArtistId']}' class='button'>🧾 Edit</a>
                        <a href='confirm_delete.php?id={$row['ArtistId']}' class='button button-danger'>❌ Delete</a>
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
