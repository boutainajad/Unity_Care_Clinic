<?php
require_once '../../config/connexion.php';

if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];
    
    $sql = "DELETE FROM patients WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $patient_id);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../../pages/patients.php");
        exit();
    } else {
        echo "Error deleting patient: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../../pages/patients.php");
    exit();
}
?>