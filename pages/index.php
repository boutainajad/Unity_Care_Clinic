   <?php
require_once '../config/connexion.php';

// Patients count
$sqlPatients = "SELECT COUNT(*) as total FROM patients";
$resultPatients = mysqli_query($conn, $sqlPatients);
$patientsCount = mysqli_fetch_assoc($resultPatients)['total'];

// Doctors count
$sqlDoctors = "SELECT COUNT(*) as total FROM doctors";
$resultDoctors = mysqli_query($conn, $sqlDoctors);
$doctorsCount = mysqli_fetch_assoc($resultDoctors)['total'];

// Departments count
$sqlDepartments = "SELECT COUNT(*) as total FROM departments";
$resultDepartments = mysqli_query($conn, $sqlDepartments);
$departmentsCount = mysqli_fetch_assoc($resultDepartments)['total'];

// patients list
$sqlList = "SELECT first_name, last_name, phone_number, email FROM patients";
$resultList = mysqli_query($conn, $sqlList);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Unity Care Clinic</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>

<div class="layout">

    <aside class="sidebar">
        <h2 class="logo">Unity Care</h2>
        <ul>
            <li class="active">Dashboard</li>
            <li>Doctors</li>
            <li>Patients</li>
            <li>Departments</li>
            <li>Reports</li>
        </ul>
    </aside>

    <main class="main">


        <section class="cards">
            <div class="card">
                <h3>Patients</h3>
                <p><?php echo $patientsCount; ?></p>
            </div>
            <div class="card">
                <h3>Doctors</h3>
                <p><?php echo $doctorsCount; ?></p>
            </div>
            <div class="card">
                <h3>Departments</h3>
                <p><?php echo $departmentsCount; ?></p>
            </div>
        </section>

        <section class="table-section">
            <h3>Patients List</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($resultList)) {
                        echo "<tr>";
                        echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                        echo "<td>" . $row['phone_number'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

    </main>

</div>

</body>
</html>
