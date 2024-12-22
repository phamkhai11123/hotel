<?php  
session_start();  
if(isset($_SESSION["user"])) {  
    header("location: home.php");  
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #clouds {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .fontawesome-user,
        .fontawesome-lock {
            font-size: 20px;
            color: #555;
        }
    </style>
</head>

<body>
    <div id="clouds">
        <div class="cloud x1"></div>
        <div class="cloud x2"></div>
        <div class="cloud x3"></div>
        <div class="cloud x4"></div>
        <div class="cloud x5"></div>
    </div>

    <div class="container">
        <div id="login">
            <form method="post">
                <fieldset class="clearfix">
                    <p><span class="fontawesome-user"></span><input type="text" name="user" placeholder="Username" required></p>
                    <p><span class="fontawesome-lock"></span><input type="password" name="pass" placeholder="Password" required></p>
                    <p><input type="submit" name="sub" value="Login"></p>
                </fieldset>
            </form>
        </div> <!-- end login -->

        
    </div>
</body>
</html>

<?php
include('db.php');

// Kiểm tra session trước khi hiển thị form đăng nhập
if(isset($_SESSION["user"])) {  
    header("location: home.php");  
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra kết nối với cơ sở dữ liệu
    if (!$con) {
        die("Lỗi kết nối: " . mysqli_connect_error());
    }

    $myusername = mysqli_real_escape_string($con, $_POST['user']);
    $mypassword = mysqli_real_escape_string($con, $_POST['pass']);

    // $sql = "SELECT id, role FROM login WHERE usname = ? AND pass = ?";
    $sql = "SELECT * FROM login WHERE usname = ? AND pass = ?";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $myusername, $mypassword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row) {
        $userRole = $row['role'];

        if ($userRole == 1) {
            $_SESSION['user'] = $myusername;
            $_SESSION['email'] = $row['email']; // Add this line to store email in session
            header("location: home.php");
            exit();
        } else if ($userRole == 0) {
          $_SESSION['email'] = $row['email']; // Add this line to store email in session
            $_SESSION['user'] = $myusername;
                $userName = $row['name'];
                header("location: ../index.php?user=" . urlencode($userName));
        } else {
            echo '<script>alert("Invalid role") </script>';
        }
    } else {
        echo '<script>alert("Tên tài khoản hoặc mật khẩu không chính xác") </script>';
    }

    // Đóng prepared statement
    mysqli_stmt_close($stmt);

    // Đóng kết nối với cơ sở dữ liệu
    mysqli_close($con);
}
?>
