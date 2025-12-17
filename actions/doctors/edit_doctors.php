<?php
require_once '../../config/connexion.php';
$error = "";

$doctor_id = $_GET['id'] ?? null;
if (!$doctor_id) { header("Location: doctors.php"); exit(); }

$sql = "SELECT * FROM doctors WHERE doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();
$stmt->close();

$departments = [];
$dept_result = $conn->query("SELECT department_id, department_name FROM departments");
while ($row = $dept_result->fetch_assoc()) { $departments[] = $row; }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $specialisation = $_POST['specialisation'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $department_id = $_POST['department_id'];

    $sql = "UPDATE doctors SET firs_name=?, last_name=?, specialisation=?, phone_number=?, email=?, department_id=? WHERE doctor_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $first_name, $last_name, $specialisation, $phone_number, $email, $department_id, $doctor_id);

    if ($stmt->execute()) { header("Location: ../../pages/doctors.php"); exit(); }
    else { $error = "Error: " . $conn->error; }

    $stmt->close();
}

include '../../includes/header.php';
?>

<div class="header">
    <h1>Edit Doctor</h1>
    <button class="btn-back" onclick="window.location.href='doctors.php'">← Back to List</button>
</div>

<div class="content-section">
    <?php if ($error) echo "<div class='alert alert-error'>$error</div>"; ?>
    <form method="POST" action="" class="form-container">
        <div class="form-group">
            <label for="first_name">First Name *</label>
            <input type="text" name="first_name" id="first_name" value="<?= $doctor['firs_name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name *</label>
            <input type="text" name="last_name" id="last_name" value="<?= $doctor['last_name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="specialisation">Specialisation *</label>
            <input type="text" name="specialisation" id="specialisation" value="<?= $doctor['specialisation'] ?>" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" value="<?= $doctor['phone_number'] ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $doctor['email'] ?>">
        </div>
        <div class="form-group">
            <label for="department_id">Department *</label>
            <select name="department_id" id="department_id" required>
                <?php foreach($departments as $dept): ?>
                    <option value="<?= $dept['department_id'] ?>" <?= $doctor['department_id'] == $dept['department_id'] ? 'selected' : '' ?>><?= $dept['department_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-submit">Update Doctor</button>
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
    background: #ffffff;
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

<?php include '../../includes/footer.php'; ?>
