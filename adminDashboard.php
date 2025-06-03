<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="jquery.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .panel-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
        }

        .panel {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            width: 280px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .panel h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin: 8px 0;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
        }

        button {
            padding: 10px 20px;
            margin-top: 10px;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            background-color: white;
            color: #4e54c8;
            cursor: pointer;
            transition: 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #4e54c8;
            color: white;
            transform: scale(1.05);
        }

        #status {
            margin-top: 30px;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }

        @media (max-width: 600px) {
            .panel-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <h2>Admin Panel</h2>

    <div class="panel-container">
        <!-- Register Student -->
        <div class="panel">
            <h3>Register Student</h3>
            <input type="text" id="roll_no" placeholder="Roll No">
            <input type="text" id="name" placeholder="Name">
            <input type="email" id="email" placeholder="Email">
            <button onclick="registerStudent()">Register</button>
        </div>

        <!-- Delete Student -->
        <div class="panel">
            <h3>Delete Student</h3>
            <input type="text" id="droll_no" placeholder="Roll No">
            <button onclick="deleteStudent()">Delete</button>
        </div>

        <!-- Register Faculty -->
        <div class="panel">
            <h3>Register Faculty</h3>
            <input type="text" id="fid" placeholder="Faculty ID">
            <input type="text" id="fname" placeholder="Name">
            <input type="password" id="fpass" placeholder="Password">
            <button onclick="registerFaculty()">Register</button>
        </div>

        <!-- Delete Faculty -->
        <div class="panel">
            <h3>Delete Faculty</h3>
            <input type="text" id="dfid" placeholder="Faculty ID">
            <button onclick="deleteFaculty()">Delete</button>
        </div>
    </div>

    <div id="status"></div>

    <script>
        function registerStudent() {
            $.post("ajaxhandler/adminActions.php", {
                action: "registerStudent",
                roll_no: $('#roll_no').val(),
                name: $('#name').val(),
                email: $('#email').val()
            }, res => $('#status').text(res.message), 'json');
        }

        function deleteStudent() {
            $.post("ajaxhandler/adminActions.php", {
                action: "deleteStudent",
                roll_no: $('#droll_no').val()
            }, res => $('#status').text(res.message), 'json');
        }

        function registerFaculty() {
            $.post("ajaxhandler/adminActions.php", {
                action: "registerFaculty",
                faculty_id: $('#fid').val(),
                name: $('#fname').val(),
                password: $('#fpass').val()
            }, res => $('#status').text(res.message), 'json');
        }

        function deleteFaculty() {
            $.post("ajaxhandler/adminActions.php", {
                action: "deleteFaculty",
                faculty_id: $('#dfid').val()
            }, res => $('#status').text(res.message), 'json');
        }
    </script>
</body>
</html>
