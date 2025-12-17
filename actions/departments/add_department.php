<?php
require_once '../../config/connexion.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $department_name = $_POST['department_name'];
    $location = $_POST['location'];
    
    $sql = "INSERT INTO departments (department_name, location) VALUES (?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $department_name, $location);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../../pages/departments.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}

include '../../includes/header.php';
?>

<div class="header">
    <h1>Add New Department</h1>
    <button class="btn-back" onclick="window.location.href='../../pages/departments.php'">← Back to List</button>
</div>

<div class="content-section">
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST" action="" class="form-container">
        <div class="form-group">
            <label for="department_name">Department Name *</label>
            <input type="text" id="department_name" name="department_name" required>
        </div>
        
        <div class="form-group">
            <label for="location">Location *</label>
            <input type="text" id="location" name="location" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">Add Department</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='../../pages/departments.php'">Cancel</button>
        </div>
    </form>
</div>
<style>
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header h1 {
    margin: 0;
    color: #333;
}

.btn-back {
    background-color: #6c757d;
    color: #fff;
    border: none;
    padding: 8px 14px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-back:hover {
    background-color: #5a6268;
}

.content-section {
    max-width: 600px;
    margin: auto;
    background: #fff;
    padding: 25px;
    border-radius: 6px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.alert-error {
    background-color: #f8d7da;
    color: #842029;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 15px;
}

.form-container {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}

.form-group input {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-group input:focus {
    outline: none;
    border-color: #007bff;
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn-submit {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-submit:hover {
    background-color: #0056b3;
}

.btn-cancel {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-cancel:hover {
    background-color: #b02a37;
}
</style>


<?php
include '../../includes/footer.php';
?>