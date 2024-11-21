<?php
$host = 'localhost';
$user = 'root';
$password = '';
try {
    $conn = new PDO("mysql:host=$host;port=3306;dbname=test97", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
