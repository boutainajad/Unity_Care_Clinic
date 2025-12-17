<?php
require_once '../../config/connexion.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['genre'];
    $date_of_birth = $_POST['date_of_birth'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $adress = $_POST['adress'];

    $sql = "INSERT INTO patients (first_name, last_name, genre, date_of_birth, phone_number, email, adress) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $gender, $date_of_birth, $phone_number, $email, $adress);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../../pages/patients.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
        $stmt->close();
        $conn->close();
    }
}

include '../../includes/header.php';
?>

<div class="header">
    <h1>Add New Patient</h1>
    <button class="btn-back" onclick="window.location.href='../../pages/patients.php'">← Back to List</button>
</div>

<div class="content-section">
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="" class="form-container">
        <div class="form-row">
            <div class="form-group">
                <label for="first_name">First Name *</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            
            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="genre">Gender *</label>
                <select id="genre" name="genre" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="date_of_birth">Date of Birth *</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="phone_number">Phone Number *</label>
                <input type="tel" id="phone_number" name="phone_number" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="adress">Address *</label>
            <textarea id="adress" name="adress" rows="3" required></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">Add Patient</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='../../pages/patients.php'">Cancel</button>
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
        max-width: 800px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
    }
    
    .form-group label {
        margin-bottom: 8px;
        font-weight: bold;
        color: #2c3e50;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
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
