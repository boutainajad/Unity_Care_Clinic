<?php
include '../includes/header.php';
require_once '../config/connexion.php';
?>

<div class="header">
    <h1>Doctors List</h1>
    <button class="btn-add" onclick="window.location.href='add_doctor.php'">+ Add Doctor</button>
</div>

<div class="content-section">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Specialization</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT d.doctor_id, d.firs_name, d.last_name, d.specialisation, d.phone_number, d.email, dept.department_name 
                    FROM doctors d
                    LEFT JOIN departments dept ON d.department_id = dept.department_id";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['firs_name']) . " " . htmlspecialchars($row['last_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['specialisation']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['department_name'] ?? 'N/A') . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<button class='btn-edit' onclick=\"window.location.href='edit_doctor.php?id=" . $row['doctor_id'] . "'\">Edit</button>";
                    echo "<button class='btn-delete' onclick=\"confirmDelete(" . $row['doctor_id'] . ")\">Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No doctors found</td></tr>";
            }
            
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this doctor?')) {
        window.location.href = 'delete_doctor.php?id=' + id;
    }
}
</script>

<?php
include '../includes/footer.php';
?>