   <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Unity Care Clinic</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<div class="layout">

    <!-- Sidebar -->
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

    <!-- Main -->
    <main class="main">

        <!-- Top bar -->
        <header class="topbar">
            <input type="text" placeholder="Search...">
            <div class="profile">Admin</div>
        </header>

        <!-- KPI cards -->
        <section class="cards">
            <div class="card">
                <h3>Patients</h3>
                <p>176</p>
            </div>
            <div class="card">
                <h3>Doctors</h3>
                <p>24</p>
            </div>
            <div class="card">
                <h3>Departments</h3>
                <p>8</p>
            </div>
        </section>

        <!-- Table -->
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
                    <tr>
                        <td>John Doe</td>
                        <td>0600000000</td>
                        <td>john@gmail.com</td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>0700000000</td>
                        <td>jane@gmail.com</td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

</div>

</body>
</html>
