<?php
require_once 'db.php';

$stmt = $pdo->query("SHOW TABLES");
echo "<h2>Tables in chinook:</h2><ul>";
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    echo "<li>{$row[0]}</li>";
}
echo "</ul>";
