<?php

$servername = "127.0.0.1";
$username = "Felix";
$password = "1234";
$dbname = "TestDatenbank";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
die("Error: " . $conn->connect_error);
}
$conn->query("CREATE DATABASE IF NOT EXISTS TestDatenbank");


$conn->select_db("TestDatenbank");


$conn->query("CREATE TABLE zahlenTabelle (id INT AUTO_INCREMENT PRIMARY KEY, zahl INT NOT NULL)");

$startInsert = microtime(true);
for ($i = 0; $i < 1000; $i++) {
$zufallszahl = rand(1, 10000);
$conn->query("INSERT INTO zahlenTabelle (zahl) VALUES ($zufallszahl)");
}
$endInsert = microtime(true);

$startFetch = microtime(true);
$resultat = $conn->query("SELECT zahl FROM zahlenTabelle");
while ($zeile = $resultat->fetch_assoc()) {
//echo $zeile["zahl"] . "<br>";
}
$endFetch = microtime(true);

echo "Insert SQLi: " . ($endInsert - $startInsert) . " sec";
echo "<br>";
echo "Select SQLi: " . ($endFetch - $startFetch) . " sec";

$conn->close();
