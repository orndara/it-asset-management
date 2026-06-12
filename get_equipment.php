<?php
include 'db_connection.php';

if(isset($_GET['id'])) {
    // Get single equipment
    $id = $_GET['id'];
    $sql = "SELECT * FROM equipment WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    // Get all equipment with filters
    $search = $_GET['search'] ?? '';
    $category = $_GET['category'] ?? '';
    $status = $_GET['status'] ?? '';
    
    $sql = "SELECT * FROM equipment WHERE 1=1";
    $params = [];
    $types = "";
    
    if($search) {
        $sql .= " AND (name LIKE ? OR serial_number LIKE ? OR assigned_to LIKE ?)";
        $searchParam = "%$search%";
        $params = array_merge($params, [$searchParam, $searchParam, $searchParam]);
        $types .= "sss";
    }
    if($category) {
        $sql .= " AND category = ?";
        $params[] = $category;
        $types .= "s";
    }
    if($status) {
        $sql .= " AND status = ?";
        $params[] = $status;
        $types .= "s";
    }
    
    $sql .= " ORDER BY created_at DESC";
    
    $stmt = $conn->prepare($sql);
    if(!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $index = 1;
        while($row = $result->fetch_assoc()) {
            $statusClass = '';
            if($row['status'] == 'កំពុងប្រើប្រាស់') $statusClass = 'status-active';
            elseif($row['status'] == 'កំពុងជួសជុល') $statusClass = 'status-repair';
            elseif($row['status'] == 'ស្តុកទុក') $statusClass = 'status-stock';
            else $statusClass = 'status-other';
            
            echo "<tr>";
            echo "<td>{$index}</td>";
            echo "<td><strong>" . htmlspecialchars($row['name']) . "</strong></td>";
            echo "<td>" . htmlspecialchars($row['serial_number']) . "</td>";
            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
            echo "<td><span class='status-badge {$statusClass}'>" . htmlspecialchars($row['status']) . "</span></td>";
            echo "<td>" . htmlspecialchars($row['assigned_to']) . "</td>";
            echo "<td>" . ($row['price'] ? '$' . number_format($row['price'], 2) : '-') . "</td>";
            echo "<td class='action-buttons'>";
            echo "<button class='action-btn edit-btn' onclick='editEquipment({$row['id']})'><i class='fas fa-edit'></i> កែ</button>";
            echo "<button class='action-btn delete-btn' onclick='deleteEquipment({$row['id']})'><i class='fas fa-trash'></i> លុប</button>";
            echo "</td></tr>";
            $index++;
        }
    } else {
        echo "<tr><td colspan='8' style='text-align:center; padding:50px;'>មិនមានទិន្នន័យ</td></tr>";
    }
}

$conn->close();
?>