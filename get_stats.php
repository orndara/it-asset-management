<?php
include 'db_connection.php';

$total = $conn->query("SELECT COUNT(*) as count FROM equipment")->fetch_assoc()['count'];
$active = $conn->query("SELECT COUNT(*) as count FROM equipment WHERE status='កំពុងប្រើប្រាស់'")->fetch_assoc()['count'];
$repair = $conn->query("SELECT COUNT(*) as count FROM equipment WHERE status='កំពុងជួសជុល'")->fetch_assoc()['count'];
$stock = $conn->query("SELECT COUNT(*) as count FROM equipment WHERE status='ស្តុកទុក'")->fetch_assoc()['count'];

echo json_encode([
    'total' => $total,
    'active' => $active,
    'repair' => $repair,
    'stock' => $stock
]);

$conn->close();
?>