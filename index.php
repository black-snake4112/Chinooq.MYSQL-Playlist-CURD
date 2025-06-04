<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chinook Management Portal</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="navigationbar">
  <h2>🎵 Crafted with by Ghulam Murtaza 🎵</h2>
  <nav>
    <a href="index.php" class="nav-link">🏠 Home</a>
    <a href="artist/read.php" class="nav-link">🎤 Artists</a>
    <a href="track/read.php" class="nav-link">🎼 Tracks</a>
    <a href="album/read.php" class="nav-link">📁 Albums</a>
  </nav>
</header>

<main class="Focus-Section">
  <img src="images/logo.png" alt="Chinook Logo" class="logo" />
  <h1>Welcome to Chinook Music Manager 🎧</h1>

  <!-- Album button below heading -->
   <h2>📁 Manage Alubms</h2>
   <p>Create, edit, and delete albums in the Chinook database.</p>
  <a href="album/read.php" class="button"> Manage Albums</a>

  <div class="grid-container">
    <div class="card">
      <h2>🎤 Manage Artists</h2>
      <p>Create, edit, and delete artists in the Chinook database.</p>
      <a href="artist/read.php" class="button">Manage Artists</a>
    </div>

    <div class="card">
      <h2>🎼 Manage Tracks</h2>
      <p>Handle track listings, genres, and album assignments in the Chinook database.</p>
      <a href="track/read.php" class="button">Manage Tracks</a>
    </div>
  </div>
</main>

<!-- Code for footer at the bottom -->
<footer class="footer">
    🎵 Crafted with by <strong>Ghulam Murtaza</strong> | Roll Number: <strong>B01801612</strong> |
    Chinook Album Manager 2025 | Subject: <strong>Server Side Web Development</strong> |
    Module Coordinator & Lead Tutor: <strong>Graeme McRobbie</strong> 🎶
</footer>

</body>
</html>
