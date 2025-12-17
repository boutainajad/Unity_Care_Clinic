<?php
require_once '../../config/connexion.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['genre'];
    $date_of_birth = $_POST['date_of_birth'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $adress = $_POST['adress'];

    $sql = "UPDATE patients SET first_name=?, last_name=?, genre=?, date_of_birth=?, phone_number=?, email=?, adress=? WHERE patient_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $first_name, $last_name, $gender, $date_of_birth, $phone_number, $email, $adress, $patient_id);

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
    <h1>Edit Patient</h1>
    <button class="btn-back" onclick="window.location.href='../../pages/patients.php'">← Back to List</button>
</div>

<div class="content-section">
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="" class="form-container">
        <input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
        <div class="form-row">
            <div class="form-group">
                <label for="first_name">First Name *</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name ?? ''); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name ?? ''); ?>" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="genre">Gender *</label>
                <select id="genre" name="genre" required>
                    <option value="">Select Gender</option>
                    <option value="Male" <?php if (($gender ?? '') === 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if (($gender ?? '') === 'Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="date_of_birth">Date of Birth *</label>
                <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($date_of_birth ?? ''); ?>" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="phone_number">Phone Number *</label>
                <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($phone_number ?? ''); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="adress">Address *</label>
            <textarea id="adress" name="adress" rows="3" required><?php echo htmlspecialchars($adress ?? ''); ?></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-submit">Save Changes</button>
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
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-submit:hover {
    background-color: #1e7e34;
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
