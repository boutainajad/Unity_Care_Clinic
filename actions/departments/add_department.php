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
    .btn-back {
        background-color: #95a5a6;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }
    
    .btn-back:hover {
        background-color: #7f8c8d;
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    .form-container {
        max-width: 600px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }
    
    .form-group label {
        margin-bottom: 8px;
        font-weight: bold;
        color: #2c3e50;
    }
    
    .form-group input {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .form-group input:focus {
        outline: none;
        border-color: #3498db;
    }
    
    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }
    
    .btn-submit {
        background-color: #27ae60;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    
    .btn-submit:hover {
        background-color: #229954;
    }
    
    .btn-cancel {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }
    
    .btn-cancel:hover {
        background-color: #c0392b;
    }
</style>

<?php
include '../../includes/footer.php';
?>