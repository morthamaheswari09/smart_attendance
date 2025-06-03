<?php
session_start();

// If not logged in, redirect to login
if (!isset($_SESSION['student_id'])) {
    header("Location: studentLogin.php");
    exit();
}

$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path . "/attendanceapp/database/database.php";
require_once $path . "/attendanceapp/database/studentDetails.php";

$dbo = new Database();
$sdo = new student_details();
$studentInfo = $sdo->getStudentById($dbo, $_SESSION['student_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f0f2f5;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logout-btn {
            padding: 8px 14px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <h2>Welcome, <?php echo htmlspecialchars($studentInfo['name']); ?></h2>
        <a class="logout-btn" href="studentLogout.php">Logout</a>
    </div>

    <hr><br>
    <h3>Your Attendance Records</h3>

    <!-- Attendance table or logic here -->

</body>
</html>