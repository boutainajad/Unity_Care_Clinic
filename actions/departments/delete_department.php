<?php
require_once '../../config/connexion.php';

if (isset($_GET['id'])) {
    $department_id = $_GET['id'];
    
    $sql = "DELETE FROM departments WHERE department_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $department_id);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../../pages/departments.php");
        exit();
    } else {
        echo "Error deleting department: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../../pages/departments.php");
    exit();
}
?>