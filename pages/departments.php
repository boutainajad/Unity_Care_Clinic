<?php
include '../includes/header.php';
require_once '../config/connexion.php';

?>

<div class="header">
    <h1>Departments List</h1>
    <button class="btn-add" onclick="window.location.href='add_department.php'">+ Add Department</button>
</div>
 
<div class="content-section">
    <table>
        <thead>
            <tr>
                <th>Department Name</th>
                <th>Location</th>
                <th>Total Doctors</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT d.department_id, d.department_name, d.location, COUNT(doc.doctor_id) as doctor_count 
                    FROM departments d
                    LEFT JOIN doctors doc ON d.department_id = doc.department_id
                    GROUP BY d.department_id, d.department_name, d.location";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['department_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['doctor_count']) . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<button class='btn-edit' onclick=\"window.location.href='edit_department.php?id=" . $row['department_id'] . "'\">Edit</button>";
                    echo "<button class='btn-delete' onclick=\"confirmDelete(" . $row['department_id'] . ")\">Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No departments found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this department?')) {
        window.location.href = 'delete_department.php?id=' + id;
    }
}
</script>

<?php
include '../includes/footer.php';
?>