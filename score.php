<?php
    include "database.php";
    global $db;
    // Xử lý tra cứu điểm
    if ($_POST) {
        // Lấy dữ liệu từ form
        $studentCode = $_POST["studentCode"];
        $studentName = $_POST["studentName"];

        $query = "SELECT u.code, u.username, s.avg FROM users u LEFT JOIN score s ON s.code = u.code WHERE u.code = '$studentCode' AND u.username = '$studentName'";

        $queries = explode(";", $query);

        foreach ($queries as $singleQuery) {
            $singleQuery = trim($singleQuery);

            if (!empty($singleQuery)) {
                $statement = $db->prepare($singleQuery);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($results)) {
                    echo "<table>";
                    echo "<tr>";
            
                    // Lặp qua từng bản ghi và hiển thị các trường
                    foreach ($results as $result) {
                        foreach ($result as $field => $value) {
                            echo "<th>".$field."</th>";
                        }
                        break; // Chỉ lấy trường của bản ghi đầu tiên
                    }
            
                    echo "</tr>";
            
                    foreach ($results as $result) {
                        echo "<tr>";
            
                        // Lặp qua từng trường và hiển thị giá trị tương ứng
                        foreach ($result as $field => $value) {
                            echo "<td>".$value."</td>";
                        }
            
                        echo "</tr>";
                    }
            
                    echo "</table>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tra cứu điểm</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 400px;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"] {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        input[type="submit"] {
            padding: 6px 12px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <label for="studentCode">Mã sinh viên:</label>
        <input type="text" id="studentCode" name="studentCode">

        <label for="studentName">Tên sinh viên:</label>
        <input type="text" id="studentName" name="studentName">

        <input type="submit" value="Tra cứu">
    </form>
           