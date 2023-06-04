<?php
ob_start();
session_start();
// Thông tin kết nối cơ sở dữ liệu PostgreSQL
include "database.php";
global $db;

// Biến thông báo
$message = "";

// Xử lý đăng nhập khi form được gửi đi
if ($_POST) {
    // Lấy dữ liệu từ form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Truy vấn kiểm tra người dùng
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = '$role'";
    $statement = $db->prepare($query);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra kết quả
    if ($statement->rowCount() > 0) {
        $message = "Success"; // Đăng nhập thành công

        print_r($user);

        if ($user['role'] == 'hocsinh') {
            header("Location: score.php");
            exit();
        } elseif ($user['role'] == 'giangvien') {
            header("Location: manager.php");
            exit();
        }
    } else {
        $message = "Invalid username or password"; // Sai tên đăng nhập hoặc mật khẩu
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        label, input, select {
            display: block;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Vai trò:</label>
        <select id="role" name="role">
            <option value="giangvien">Giáo viên</option>
            <option value="hocsinh">Học sinh</option>
        </select>

        <input type="submit" value="Đăng nhập">

        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>