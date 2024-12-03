<?php
require_once 'dbconnect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['id'])) {
    $laptopId = $_GET['id'];
    $sql = 'delete from laptop where laptop_id=?';
    $stmt = $conn->prepare($sql);
    $status = $stmt->execute([$laptopId]);
    if ($status) {
        $_SESSION['deleteLaptopSuccess'] = "Laptop with id $laptopId has been deleted.";
        header("location:viewLaptop.php");
    }
}
