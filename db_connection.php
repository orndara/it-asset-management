<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'it_asset_db';

// បង្កើតការតភ្ជាប់
$conn = new mysqli($host, $username, $password, $database);

// ពិនិត្យការតភ្ជាប់
if ($conn->connect_error) {
    die("ការតភ្ជាប់បរាជ័យ: " . $conn->connect_error);
}

// កំណត់ charset ជា UTF-8
$conn->set_charset("utf8mb4");
?>