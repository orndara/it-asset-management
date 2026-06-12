<?php
include 'db_connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$serial_number = $_POST['serial_number'];
$category = $_POST['category'];
$status = $_POST['status'];
$assigned_to = $_POST['assigned_to'];
$purchase_date = $_POST['purchase_date'];
$price = $_POST['price'];
$notes = $_POST['notes'];

$sql = "UPDATE equipment SET name=?, serial_number=?, category=?, status=?, 
        assigned_to=?, purchase_date=?, price=?, notes=? WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssdsi", $name, $serial_number, $category, $status, 
                  $assigned_to, $purchase_date, $price, $notes, $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>