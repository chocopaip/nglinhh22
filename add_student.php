<?php
$conn = new mysqli("localhost", "root", "", "qlsv_nguyenngoclinh");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level = $_POST['level'];
    $group = $_POST['group'];

    $sql = "INSERT INTO table_Students (fullname, dob, gender, hometown, level, `group`) 
            VALUES ('$fullname', '$dob', '$gender', '$hometown', '$level', '$group')";
    $conn->query($sql);
    header("Location: index.php");
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Thêm sinh viên mới</title>
    <style>
 
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

 
        h1 {
            text-align: center;
            margin-top: 40px;
            color: #333;
        }

       
        form {
            width: 40%;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

      
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        form input[type="text"], form input[type="date"], form input[type="number"], form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        form input[type="radio"] {
            margin-right: 5px;
        }

        form button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        form button:hover {
            background-color: #45a049;
        }

      
        input[type="radio"] {
            margin-right: 10px;
        }

       
        form select {
            margin-bottom: 15px;
        }

    
        form input[type="text"]:focus, form input[type="date"]:focus, form input[type="number"]:focus, form select:focus {
            border-color: #4CAF50;
        }


        form input[type="text"], form input[type="date"], form input[type="number"], form select {
            font-size: 16px;
        }

        form button:active {
            background-color: #388E3C;
        }

        form input[type="text"]:invalid, form input[type="number"]:invalid {
            border-color: #e74c3c;
        }
    </style>
</head>
<body>
    <h1>Thêm sinh viên mới</h1>
    <form action="add_student.php" method="POST">
        <label>Họ và tên:</label><input type="text" name="fullname" required><br>
        <label>Ngày sinh:</label><input type="date" name="dob" required><br>
        <label>Giới tính:</label>
        <input type="radio" name="gender" value="1" required> Nam
        <input type="radio" name="gender" value="0"> Nữ<br>
        <label>Quê quán:</label><input type="text" name="hometown" required><br>
        <label>Trình độ:</label>
        <select name="level">
            <option value="0">Tiến sĩ</option>
            <option value="1">Thạc sĩ</option>
            <option value="2">Kỹ sư</option>
            <option value="3">Khác</option>
        </select><br>
        <label>Nhóm:</label><input type="number" name="group" required><br>
        <button type="submit">Lưu</button>
    </form>
</body>
</html>
