<?php
class student_details {
    public function verifyStudent($dbo, $roll_no) {
        $conn = $dbo->getConnection();

        $sql = "SELECT id, roll_no, name FROM student_details WHERE roll_no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $roll_no);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return [
                "status" => "OK",
                "id" => $row["id"],
                "name" => $row["name"],
                "roll_no" => $row["roll_no"]
            ];
        } else {
            return [
                "status" => "FAIL",
                "message" => "Student not found."
            ];
        }
    }
    public function getStudentById($dbo, $id) {
    $conn = $dbo->getConnection();

    $sql = "SELECT id, name, roll_no FROM student_details WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row;
    } else {
        return null;
    }
}

}
?>
