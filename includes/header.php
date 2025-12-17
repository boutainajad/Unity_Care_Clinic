<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unity Care - <?php echo isset($pageTitle) ? $pageTitle : 'Dashboard'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
        }
        
        .sidebar h2 {
            margin-bottom: 30px;
            font-size: 24px;
        }
        
        .sidebar ul {
            list-style: none;
        }
        
        .sidebar ul li {
            margin-bottom: 15px;
        }
        
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .sidebar ul li a:hover {
            background-color: #34495e;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .header {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .btn-add {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .btn-add:hover {
            background-color: #229954;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn-edit {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .btn-edit:hover {
            background-color: #2980b9;
        }
        
        .btn-delete {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .btn-delete:hover {
            background-color: #c0392b;
        }
        
        .content-section {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        table th {
            background-color: #3498db;
            color: white;
        }
        
        table tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Unity Care</h2>
        <ul>
            <li><a href="/Unity_Care_Clinic/index.php">Dashboard</a></li>
            <li><a href="/Unity_Care_Clinic/pages/doctors.php">Doctors</a></li>
            <li><a href="/Unity_Care_Clinic/pages/patients.php">Patients</a></li>
            <li><a href="/Unity_Care_Clinic/pages/departments.php">Departments</a></li>
        </ul>
       
    </div>
    
    <div class="main-content">