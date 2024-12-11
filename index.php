<?php
include 'dbconnect.php';

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);

    $sql = "DELETE FROM table_Students WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Xóa sinh viên thành công!</p>";
        } else {
            echo "<p style='color: red;'>Có lỗi xảy ra khi xóa sinh viên.</p>";
        }
    } else {
        echo "<p style='color: red;'>Không thể chuẩn bị câu lệnh SQL.</p>";
    }

    $stmt->close();
}

$sql = "SELECT * FROM table_Students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 20px;
    color: #333;
}


.top-container {
    display: flex;
    justify-content: space-between;  
    width: 80%; 
    margin: 20px auto;
    align-items: center;
}


a.add-student {
    text-decoration: none;
    color: white;
    background-color: #4C6750;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    display: inline-block;
    width: 250px; 
    text-align: center;
    margin-left: 20px; 
    float: right;
}

a.add-student:hover {
    background-color: #45a049;
}

form {
    display: flex;
    width: 100%;
    margin: 0;
}

form input[type="text"] {
    padding: 10px;
    width: calc(100% - 180px); 
    max-width: 100%;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
}

form button:hover {
    background-color: #45a049;
}


table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
}

table th, table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

table th {
    background-color: #4CAF50;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #ddd;
}

table td a {
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 5px;
    margin: 0 5px;
}

table td a.edit {
    background-color: #007BFF;
    color: white;
}

table td a.edit:hover {
    background-color: #0056b3;
}

table td a.delete {
    background-color: #dc3545;
    color: white;
}

table td a.delete:hover {
    background-color: #c82333;
}

td[colspan="8"] {
    text-align: center;
    color: #888;
    font-style: italic;
}

    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>

    <!-- Container for "Add Student" button and search form -->
    <div class="top-container">
        
        <!-- Search form -->
        <form method="GET" action="search.php">
            <input type="text" name="keyword" placeholder="Tìm kiếm theo tên hoặc quê quán">
            <button type="submit">Tìm kiếm</button>
        </form>
        <a href="add_student.php" class="add-student">Thêm sinh viên mới</a>
    </div>

    <!-- Student table -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Họ và tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Quê quán</th>
            <th>Trình độ</th>
            <th>Nhóm</th>
            <th>Hành động</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['dob']) ?></td>
                <td><?= $row['gender'] == 1 ? 'Nam' : 'Nữ' ?></td>
                <td><?= htmlspecialchars($row['hometown']) ?></td>
                <td>
                    <?php
                    switch ($row['level']) {
                        case 0: echo "Tiến sĩ"; break;
                        case 1: echo "Thạc sĩ"; break;
                        case 2: echo "Kỹ sư"; break;
                        default: echo "Khác"; break;
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars($row['group']) ?></td>
                <td>
                    <a href="edit_student.php?id=<?= $row['id'] ?>" class="edit">Sửa</a> | 
                    <a href="?delete_id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Không có dữ liệu sinh viên.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
