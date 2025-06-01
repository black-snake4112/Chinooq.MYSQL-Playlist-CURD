<?php

require_once 'db.php'; // this includes db.php that contains my database connection


$stmt = $pdo->query("SHOW TABLES");
echo "<h2>Tables in chinook:</h2><ul>";
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    echo "<li>{$row[0]}</li>";}
echo "</ul>";

#actually this code is useful for debugging and admin dashboards 