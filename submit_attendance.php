<?php
include("connection.php"); // adjust path if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $facid = $_POST['facid'];
    $att_date = $_POST['att_date'];
    $students = $_POST['students'] ?? [];

    $stmt = $conn->prepare("INSERT INTO attendance_details (facid, rollno, att_date, status) VALUES (?, ?, ?, ?)");

    foreach ($students as $rollno) {
        $status = "Present";
        $stmt->bind_param("ssss", $facid, $rollno, $att_date, $status);
        $stmt->execute();
    }

    echo "<script>alert('Attendance submitted successfully!'); window.location.href='attendance.php';</script>";
} else {
    echo "Invalid request.";
}
?>
