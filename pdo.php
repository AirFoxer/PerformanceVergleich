<?php
$servername = "127.0.0.1";
$username = "Felix";
$password = "1234";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec("CREATE DATABASE TestDatenbank2");

    $conn = new PDO("mysql:host=$servername;dbname=TestDatenbank2", $username, $password);

    $sql = "CREATE TABLE zahlenTabelle (id INT AUTO_INCREMENT PRIMARY KEY, zahl INT NOT NULL)";
    $conn->exec($sql);

    $startInsert = microtime(true);

    for ($i = 0; $i < 1000; $i++) {
        $zufallszahl = rand(1, 10000);
        $sql = "INSERT INTO zahlenTabelle (zahl) VALUES ($zufallszahl)";
        $conn->exec($sql);
    }

    $endInsert = microtime(true);

    $startFetch = microtime(true);

    $stmt = $conn->query("SELECT zahl FROM zahlenTabelle");

    $endFetch = microtime(true);

    echo "PDO Insert: " . ($endInsert - $startInsert) . " sec";
    echo "PDO Select: " . ($endFetch - $startFetch) . " sec>";

} catch(PDOException $e) {
    echo "Fehler: " . $e->getMessage();
}

$conn = null;

