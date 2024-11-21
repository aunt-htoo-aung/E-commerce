<?php
$host = 'localhost';
$user = 'root';
$password = '';
$conn = new PDO("mysql:host=$host;port=3306;dbname=test97", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
