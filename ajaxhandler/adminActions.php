<?php
include("../dbconnect.php");

// ✅ Debug log: Logs every POST request into admin_log.txt
file_put_contents("admin_log.txt", date("Y-m-d H:i:s") . " - POST: " . json_encode($_POST) . "\n", FILE_APPEND);

// ✅ Validate action
if (!isset($_POST['action'])) {
    echo json_encode(["message" => "No action received"]);
    exit;
}

$action = $_POST['action'];

switch ($action) {

    // ✅ Register Student
    case "registerStudent":
        if (isset($_POST['roll_no'], $_POST['name'], $_POST['email'])) {
            $stmt = $conn->prepare("INSERT INTO student_details (roll_no, name, email_id) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $_POST['roll_no'], $_POST['name'], $_POST['email']);
            $stmt->execute();
            echo json_encode(["message" => "Student Registered"]);
        } else {
            echo json_encode(["message" => "Missing student data"]);
        }
        break;

    // ✅ Delete Student
    case "deleteStudent":
        if (isset($_POST['roll_no'])) {
            $stmt = $conn->prepare("DELETE FROM student_details WHERE roll_no = ?");
            $stmt->bind_param("s", $_POST['roll_no']);
            $stmt->execute();
            echo json_encode(["message" => "Student Deleted"]);
        } else {
            echo json_encode(["message" => "Roll number required for deletion"]);
        }
        break;

    // ✅ Register Faculty
    case "registerFaculty":
        if (isset($_POST['faculty_id'], $_POST['name'], $_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO faculty_details (id, name, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $_POST['faculty_id'], $_POST['name'], $password);
            $stmt->execute();
            echo json_encode(["message" => "Faculty Registered"]);
        } else {
            echo json_encode(["message" => "Missing faculty data"]);
        }
        break;

    // ✅ Delete Faculty
    case "deleteFaculty":
        if (isset($_POST['faculty_id'])) {
            $stmt = $conn->prepare("DELETE FROM faculty_details WHERE id = ?");
            $stmt->bind_param("s", $_POST['faculty_id']);
            $stmt->execute();
            echo json_encode(["message" => "Faculty Deleted"]);
        } else {
            echo json_encode(["message" => "Faculty ID required for deletion"]);
        }
        break;

    // ❌ Invalid action
    default:
        echo json_encode(["message" => "Invalid action"]);
        break;
}
?>