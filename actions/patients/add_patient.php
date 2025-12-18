<?php
require_once '../../config/connexion.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name     = trim($_POST['first_name'] ?? '');
    $last_name      = trim($_POST['last_name'] ?? '');
    $gender         = $_POST['genre'] ?? '';
    $date_of_birth  = $_POST['date_of_birth'] ?? '';
    $phone_number   = trim($_POST['phone_number'] ?? '');
    $email          = trim($_POST['email'] ?? '');
    $adress         = trim($_POST['adress'] ?? '');

    if (empty($first_name) || empty($last_name) || empty($gender) ||
        empty($date_of_birth) || empty($phone_number) || empty($email) || empty($adress)) {
        $error = "All fields are required.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    }
    elseif (!preg_match('/^[0-9]{10}$/', $phone_number)) {
        $error = "Phone number must contain exactly 10 digits.";
    }

    if (empty($error)) {
        $sql = "INSERT INTO patients 
                (first_name, last_name, genre, date_of_birth, phone_number, email, adress)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssss",
            $first_name,
            $last_name,
            $gender,
            $date_of_birth,
            $phone_number,
            $email,
            $adress
        );

        if ($stmt->execute()) {
            header("Location: ../../pages/patients.php");
            exit();
        } else {
            $error = "Database error: " . $conn->error;
        }
        $stmt->close();
    }

    $conn->close();
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
                <input type="text" id="first_name" name="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" id="last_name" name="last_name">
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
                <input type="date" id="date_of_birth" name="date_of_birth">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="phone_number">Phone Number *</label>
                <input type="tel" id="phone_number" name="phone_number">
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email">
            </div>
        </div>
        
        <div class="form-group">
            <label for="adress">Address *</label>
            <textarea id="adress" name="adress" rows="3"></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">Add Patient</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='../../pages/patients.php'">Cancel</button>
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
    max-width: 800px;
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

.form-row {
    display: flex;
    gap: 15px;
}

.form-group {
    flex: 1;
    margin-bottom: 15px;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-group textarea {
    resize: vertical;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
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
