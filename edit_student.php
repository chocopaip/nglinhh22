
<?php
$conn = new mysqli("localhost", "root", "", "qlsv_nguyenngoclinh");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level = $_POST['level'];
    $group = $_POST['group'];

    $sql = "UPDATE table_Students SET fullname='$fullname', dob='$dob', gender='$gender', 
            hometown='$hometown', level='$level', `group`='$group' WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}
?>


<?php
$conn = new mysqli("localhost", "root", "", "qlsv_nguyenngoclinh");
$id = $_GET['id'];
$sql = "SELECT * FROM table_Students WHERE id = $id";
$student = $conn->query($sql)->fetch_assoc();
?>
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
<form action="edit_student.php" method="POST">
    <input type="hidden" name="id" value="<?= $student['id'] ?>">
    <label>Họ và tên:</label><input type="text" name="fullname" value="<?= $student['fullname'] ?>" required><br>
    <label>Ngày sinh:</label><input type="date" name="dob" value="<?= $student['dob'] ?>" required><br>
    <label>Giới tính:</label>
    <input type="radio" name="gender" value="1" <?= $student['gender'] == 1 ? 'checked' : '' ?>> Nam
    <input type="radio" name="gender" value="0" <?= $student['gender'] == 0 ? 'checked' : '' ?>> Nữ<br>
    <label>Quê quán:</label><input type="text" name="hometown" value="<?= $student['hometown'] ?>" required><br>
    <label>Trình độ:</label>
    <select name="level">
        <option value="0" <?= $student['level'] == 0 ? 'selected' : '' ?>>Tiến sĩ</option>
        <option value="1" <?= $student['level'] == 1 ? 'selected' : '' ?>>Thạc sĩ</option>
        <option value="2" <?= $student['level'] == 2 ? 'selected' : '' ?>>Kỹ sư</option>
        <option value="3" <?= $student['level'] == 3 ? 'selected' : '' ?>>Khác</option>
    </select><br>
    <label>Nhóm:</label><input type="number" name="group" value="<?= $student['group'] ?>" required><br>
    <button type="submit">Cập nhật</button>
</form>
