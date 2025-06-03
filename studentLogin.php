<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/loader.css">
    <title>Student Login</title>
</head>
<body>
    <div class="loginform">
        <div class="inputgroup topmarginlarge">
            <input type="text" id="txtRollNo" required>
            <label for="txtRollNo" id="lblRollNo">ROLL NUMBER</label>
        </div>

        <div class="divcallforaction topmarginlarge">
            <button class="btnlogin inactivecolor" id="btnLogin">LOGIN</button>
        </div>  

        <div class="diverror topmarginlarge" id="diverror">
            <label class="errormessage" id="errormessage">ERROR GOES HERE</label>
        </div>
    </div>

    <div class="lockscreen" id="lockscreen" style="display:none;">
        <div class="spinner" id="spinner"></div>
        <label class="lblwait topmargin" id="lblwait">PLEASE WAIT</label>
    </div>

    <script src="js/jquery.js"></script>
<script>
    $('#btnLogin').click(() => {
        const rollNo = $('#txtRollNo').val().trim();
        if (!rollNo) {
            $('#errormessage').text("Roll number is required.");
            $('#diverror').show();
            return;
        }

        $('#diverror').hide();
        $('#lockscreen').show();

        $.ajax({
            url: "ajaxhandler/studentLoginAjax.php",
            method: "POST",
            data: {
                roll_no: rollNo,
                action: "studentLogin"
            },
            dataType: "json",
            success: function (res) {
                console.log("Response from server:", res); // ✅ Debug

                $('#lockscreen').hide();
                if (res.status === 'OK') {
                    window.location.href = "studentDashboard.php";
                } else {
                    $('#errormessage').text(res.message);
                    $('#diverror').show();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", error); // ✅ Debug
                console.error(xhr.responseText);
                $('#lockscreen').hide();
                $('#errormessage').text("Something went wrong. Try again.");
                $('#diverror').show();
            }
        });
    });
</script>
</body>
</html>
