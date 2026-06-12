<?php
include 'db_connection.php';

$id = $_POST['id'];

$sql = "DELETE FROM equipment WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>