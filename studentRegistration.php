<!DOCTYPE html>
<html>
<head>
    <title>Register Student</title>
    <script src="js/jquery.js"></script>
</head>
<body>
    <h2>Student Registration</h2>
    <form id="studentForm">
        <label>Roll No:</label><input type="text" id="roll_no"><br>
        <label>Name:</label><input type="text" id="name"><br>
        <label>Email:</label><input type="email" id="email"><br>
        <button type="button" id="btnRegister">Register</button>
    </form>
    <div id="message"></div>

    <script>
    $("#btnRegister").on("click", function() {
        $.ajax({
            url: "ajaxhandler/studentRegisterAjax.php",
            type: "POST",
            dataType: "json",
            data: {
                roll_no: $("#roll_no").val(),
                name: $("#name").val(),
                email: $("#email").val(),
                action: "registerStudent"
            },
            success: function(res) {
                $("#message").text(res.message);
            },
            error: function() {
                $("#message").text("Something went wrong.");
            }
        });
    });
    </script>
</body>
</html>