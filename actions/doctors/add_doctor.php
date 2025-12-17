 <?php
require_once '../../config/connexion.php';

$error = "";

$departments = [];
$dept_sql = "SELECT department_id, department_name FROM departments";
$dept_result = $conn->query($dept_sql);
if ($dept_result->num_rows > 0) {
    while ($row = $dept_result->fetch_assoc()) {
        $departments[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $specialisation = $_POST['specialisation'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $department_id = $_POST['department_id'];

    $sql = "INSERT INTO doctors (firs_name, last_name, specialisation, phone_number, email, department_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $first_name, $last_name, $specialisation, $phone_number, $email, $department_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../../pages/doctors.php");
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
    <h1>Add New Doctor</h1>
    <button class="btn-back" onclick="window.location.href='doctors.php'">← Back to List</button>
</div>

<div class="content-section">
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="" class="form-container">
        <div class="form-group">
            <label for="first_name">First Name *</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name *</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>

        <div class="form-group">
            <label for="specialisation">Specialisation *</label>
            <input type="text" id="specialisation" name="specialisation" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="department_id">Department *</label>
            <select id="department_id" name="department_id" required>
                <option value="">Select Department</option>
                <?php foreach($departments as $dept): ?>
                    <option value="<?= $dept['department_id'] ?>"><?= $dept['department_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Add Doctor</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='doctors.php'">Cancel</button>
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
    max-width: 700px;
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

.form-group input,
.form-group select {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-group input:focus,
.form-group select:focus {
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
<?php include '../../includes/footer.php'; ?>
