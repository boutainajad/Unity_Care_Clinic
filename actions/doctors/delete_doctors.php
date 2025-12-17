<?php
require_once '../../config/connexion.php';

$doctor_id = $_GET['id'] ?? null;
if ($doctor_id) {
    $stmt = $conn->prepare("DELETE FROM doctors WHERE doctor_id=?");
    $stmt->bind_param("i", $doctor_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: ../../pages/doctors.php");
exit();
?>
