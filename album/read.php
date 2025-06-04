<?php require_once '../db.php'; ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Albums</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- code for navbar (top of header section or top of the page) -->
<header class="navigationbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="create.php" class="nav-link">➕ Add Album</a>
    </nav>
</header>

<main class="Focus-Section">
    <h1>📚 View All Albums</h1>

    <!-- Search and Sort Form -->
    <form method="GET" class="album-filter-form">
    <input type="text" name="search" placeholder="🔍 Find by Title or Artist" 
           value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">

    <select name="sort_by">
        <option value="AlbumId" <?php if (($_GET['sort_by'] ?? '') == 'AlbumId') echo 'selected'; ?>>Sort by ID (numbers) </option>
        <option value="Title" <?php if (($_GET['sort_by'] ?? '') == 'Title') echo 'selected'; ?>>Sort by Title (name)</option>
        <option value="Name" <?php if (($_GET['sort_by'] ?? '') == 'Name') echo 'selected'; ?>>Sort by Artist 🎤</option>
    </select>

    <select name="order">
        <option value="ASC" <?php if (($_GET['order'] ?? '') == 'ASC') echo 'selected'; ?>>Ascending order 🔼</option>
        <option value="DESC" <?php if (($_GET['order'] ?? '') == 'DESC') echo 'selected'; ?>>Descending order 🔽</option>
    </select>

    <button type="submit">🔍 Press to search</button>
</form>





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
            // Get and sanitize user input
            $search = $_GET['search'] ?? '';
            $sortBy = in_array($_GET['sort_by'] ?? '', ['AlbumId', 'Title', 'Name']) ? $_GET['sort_by'] : 'AlbumId';
            $order = in_array($_GET['order'] ?? '', ['ASC', 'DESC']) ? $_GET['order'] : 'ASC';

            // SQL query with search and sorting
            $sql = "SELECT albums.AlbumId, albums.Title, artists.Name 
                    FROM albums 
                    JOIN artists ON albums.ArtistId = artists.ArtistId 
                    WHERE albums.Title LIKE :search OR artists.Name LIKE :search 
                    ORDER BY $sortBy $order";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['search' => "%$search%"]);

            // Render table rows
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['AlbumId']}</td>
                        <td>{$row['Title']}</td>
                        <td>{$row['Name']}</td>
                        <td>
                            <a href='update.php?id={$row['AlbumId']}' class='button'>🧾 Edit</a>
                            <a href='confirm_delete.php?id={$row['AlbumId']}' class='button button-danger'>❌ Delete</a>
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
