<!DOCTYPE html>
<html>
<head>
    <title>Attendance Management Portal</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f2f2f2;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #333;
        }
        .card {
            margin: 20px auto;
            padding: 20px;
            width: 300px;
            background: white;
            box-shadow: 0 0 10px #ccc;
            border-radius: 10px;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
        }
        .button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<h1>Welcome to Attendance Management Portal</h1>

<div class="card">
    <h2>Admin Section</h2>
    <a class="button" href="studentRegistration.php">Register New Student</a>
</div>

<div class="card">
    <h2>Student Section</h2>
    <a class="button" href="studentAttendanceView.php">View Attendance</a>
</div>

</body>
</html>