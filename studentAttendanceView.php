<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Student Attendance Report</h2>
    <input type="text" id="rollno" placeholder="Enter Roll No">
    <button id="btnView">View</button>

    <canvas id="attendanceChart" width="300" height="300"></canvas>
    <div id="result"></div>

    <script>
    $("#btnView").on("click", function() {
        $.ajax({
            url: "ajaxhandler/studentAttendanceAjax.php",
            type: "POST",
            dataType: "json",
            data: {
                roll_no: $("#rollno").val(),
                action: "getAttendance"
            },
            success: function(data) {
                const attended = data.attended;
                const total = data.total;
                const absent = total - attended;

                new Chart(document.getElementById("attendanceChart"), {
                    type: 'pie',
                    data: {
                        labels: ["Present", "Absent"],
                        datasets: [{
                            data: [attended, absent],
                            backgroundColor: ["#4CAF50", "#F44336"]
                        }]
                    }
                });

                $("#result").html(`<p>Attendance: ${attended}/${total} (${data.percent}%)</p>`);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    });
    </script>
</body>
</html>