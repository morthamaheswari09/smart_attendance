<?php
session_start();
include("../dbconnect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ✅ Check if action is set and correct
    if (isset($_POST["action"]) && $_POST["action"] === "studentLogin") {

        // ✅ Validate input
        if (isset($_POST["roll_no"]) && !empty(trim($_POST["roll_no"]))) {
            $roll_no = trim($_POST["roll_no"]);

            // ✅ Prepare and execute query
            $stmt = $conn->prepare("SELECT id, name FROM student_details WHERE roll_no = ?");
            $stmt->bind_param("s", $roll_no);
            $stmt->execute();
            $result = $stmt->get_result();

            // ✅ Check result
            if ($row = $result->fetch_assoc()) {
                $_SESSION['student_id'] = $row['id'];
                $_SESSION['student_name'] = $row['name'];

                echo json_encode(["status" => "OK"]);
            } else {
                echo json_encode(["status" => "ERROR", "message" => "Invalid roll number."]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "ERROR", "message" => "Roll number is required."]);
        }

    } else {
        echo json_encode(["status" => "ERROR", "message" => "Invalid action."]);
    }

    $conn->close();
    exit;
}

echo json_encode(["status" => "ERROR", "message" => "Invalid request."]);
?>
