<?php
include 'db_connection.php';

$name = $_POST['name'];
$serial_number = $_POST['serial_number'];
$category = $_POST['category'];
$status = $_POST['status'];
$assigned_to = $_POST['assigned_to'];
$purchase_date = $_POST['purchase_date'];
$price = $_POST['price'];
$notes = $_POST['notes'];

$sql = "INSERT INTO equipment (name, serial_number, category, status, assigned_to, purchase_date, price, notes) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssds", $name, $serial_number, $category, $status, $assigned_to, $purchase_date, $price, $notes);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>