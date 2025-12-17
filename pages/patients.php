<?php
include '../includes/header.php';
require_once '../config/connexion.php';
?>

<div class="header">
    <h1>Patients List</h1>
    <button class="btn-add" onclick="window.location.href='../actions/patients/add_patient.php'">+ Add Patient</button>
</div>

<div class="content-section">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT patient_id, first_name, last_name, genre, date_of_birth, phone_number, email, adress FROM patients";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $first_name = htmlspecialchars($row['first_name'] ?? '');
                    $last_name = htmlspecialchars($row['last_name'] ?? '');
                    $gender = htmlspecialchars($row['genre'] ?? '');
                    $dob = htmlspecialchars($row['date_of_birth'] ?? '');
                    $phone = htmlspecialchars($row['phone_number'] ?? '');
                    $email = htmlspecialchars($row['email'] ?? '');
                    $adress = htmlspecialchars($row['adress'] ?? '');
                    $id = htmlspecialchars($row['patient_id'] ?? '');

                    echo "<tr>";
                    echo "<td>$first_name $last_name</td>";
                    echo "<td>$gender</td>";
                    echo "<td>$dob</td>";
                    echo "<td>$phone</td>";
                    echo "<td>$email</td>";
                    echo "<td>$adress</td>";
                    echo "<td class='action-buttons'>";
                    echo "<button class='btn-edit' onclick=\"window.location.href='../actions/patients/edit_patient.php?id=$id'\">Edit</button>";
                    echo "<button class='btn-delete' onclick=\"confirmDelete($id)\">Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No patients found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this patient?')) {
        window.location.href = '../actions/patients/delete_patient.php?id=' + id;
    }
}
</script>

<style>
.btn-add {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

.btn-add:hover {
    background-color: #2980b9;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

.action-buttons button {
    margin-right: 5px;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

.btn-edit {
    background-color: #27ae60;
    color: white;
}

.btn-edit:hover {
    background-color: #229954;
}

.btn-delete {
    background-color: #e74c3c;
    color: white;
}

.btn-delete:hover {
    background-color: #c0392b;
}
</style>

<?php
include '../includes/footer.php';
?>
