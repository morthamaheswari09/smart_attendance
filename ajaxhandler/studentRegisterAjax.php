<?php
include("../dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "registerStudent") {
    $roll_no = $_POST["roll_no"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Basic validation (optional)
    if (empty($roll_no) || empty($name) || empty($email)) {
        echo json_encode(["message" => "All fields are required."]);
        exit;
    }

    // Check if roll number already exists
    $checkStmt = $conn->prepare("SELECT id FROM student_details WHERE roll_no = ?");
    $checkStmt->bind_param("s", $roll_no);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(["message" => "Student already registered with this Roll No."]);
    } else {
        $stmt = $conn->prepare("INSERT INTO student_details (roll_no, name, email_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $roll_no, $name, $email);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Student Registered Successfully."]);
        } else {
            echo json_encode(["message" => "Database error."]);
        }
        $stmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>