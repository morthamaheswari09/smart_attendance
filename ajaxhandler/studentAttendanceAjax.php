<?php
include_once("../dbconnect.php");

if ($_POST['action'] == "getAttendance") {
    $roll = $_POST['roll_no'];

    // Fetch student ID
    $stmt = $conn->prepare("SELECT id FROM student_details WHERE roll_no = ?");
    $stmt->bind_param("s", $roll);
    $stmt->execute();
    $stmt->bind_result($sid);
    $stmt->fetch();
    $stmt->close();

    if ($sid) {
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM attendance_details WHERE student_id = ?");
        $stmt->bind_param("i", $sid);
        $stmt->execute();
        $stmt->bind_result($total);
        $stmt->fetch();
        $stmt->close();

        $stmt = $conn->prepare("SELECT COUNT(*) as attended FROM attendance_details WHERE student_id = ? AND status = 'YES'");
        $stmt->bind_param("i", $sid);
        $stmt->execute();
        $stmt->bind_result($attended);
        $stmt->fetch();
        $stmt->close();

        $percent = $total > 0 ? round(($attended / $total) * 100, 2) : 0;

        echo json_encode(["attended" => $attended, "total" => $total, "percent" => $percent]);
    } else {
        echo json_encode(["attended" => 0, "total" => 0, "percent" => 0]);
    }
}
?>
