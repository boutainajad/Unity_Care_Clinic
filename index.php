<?php
include 'includes/header.php';
require_once 'config/connexion.php';

$labels = [];
$medecinsParDepartement = [];



$total_patients = $conn->query("SELECT COUNT(*) as count FROM patients")->fetch_assoc()['count'];
$total_doctors = $conn->query("SELECT COUNT(*) as count FROM doctors")->fetch_assoc()['count'];
$total_departments = $conn->query("SELECT COUNT(*) as count FROM departments")->fetch_assoc()['count'];
$labels =  $conn->query("SELECT  department_name FROM departments")->fetch_all();
// print_r($labels);  

$sql = "SELECT COUNT(doc.doctor_id) as doctor_count 
                    FROM departments d
                    LEFT JOIN doctors doc ON d.department_id = doc.department_id
                    GROUP BY d.department_id;";
$medecinsParDepartement = $conn->query($sql)->fetch_all();



?>

<div class="header">
    <h1>Dashboard</h1>
</div>

<div class="content-section">
    <h2>Unity Care Management System</h2>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 30px;">
        <div style="background-color: #3498db; color: white; padding: 30px; border-radius: 10px; text-align: center;">
            <h3 style="margin-bottom: 10px; font-size: 36px;"><?php echo $total_patients; ?></h3>
            <p style="font-size: 18px;">Total Patients</p>
        </div>

        <div style="background-color: #2ecc71; color: white; padding: 30px; border-radius: 10px; text-align: center;">
            <h3 style="margin-bottom: 10px; font-size: 36px;"><?php echo $total_doctors; ?></h3>
            <p style="font-size: 18px;">Total Doctors</p>
        </div>

        <div style="background-color: #e74c3c; color: white; padding: 30px; border-radius: 10px; text-align: center;">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels); ?>,
            datasets: [{
                label: 'nombre medecins',
                data: <?= json_encode($medecinsParDepartement); ?>,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?php
include 'includes/footer.php';
?>