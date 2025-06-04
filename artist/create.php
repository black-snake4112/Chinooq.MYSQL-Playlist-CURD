<?php require_once '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Artist</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- code for navbar (top of header section or top of the page) -->
<header class="navigationbar">
    <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
    <nav>
        <a href="../index.php" class="nav-link">🏠 Home</a>
        <a href="read.php" class="nav-link">📚 View Artists</a>
    </nav>
</header>

<main class="Focus-Section form-box">
    <h1>➕ Add New Artist</h1>
    <form method="POST">
        <label for="name">Artist Name:</label>
        <input type="text" name="name" required>

        <button type="submit" class="button green">💾 Save</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        if (!empty($name)) {
            $stmt = $pdo->prepare("INSERT INTO artists (Name) VALUES (:name)");
            $stmt->execute([':name' => $name]);
            echo "<p style='color:green;'>Artist added successfully!</p>";
        } else {
            echo "<p class='error'>Please enter a valid name.</p>";
        }
    }
    ?>
</main>

<!-- Code for footer at the bottom -->
<footer class="footer">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>
</body>
</html>
