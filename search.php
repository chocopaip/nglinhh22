<?php
include 'dbconnect.php'; 

$search_key = isset($_GET['search_key']) ? trim($_GET['search_key']) : '';
$search_results = [];

if (!empty($search_key)) {
    
    $sql = "SELECT * FROM table_Students WHERE fullname LIKE ? OR hometown LIKE ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $key = '%' . $search_key . '%'; 
        $stmt->bind_param("ss", $key, $key);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
        $stmt->close();
    } else {
        echo "Có lỗi khi thực hiện truy vấn.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm sinh viên</title>
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

        a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
            margin-left: 20px;
        }

        a:hover {
            color: #45a049;
        }

        form {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        form input[type="text"] {
            padding: 10px;
            width: 300px;
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
            color: #007BFF;
        }

        table td a:hover {
            color: #0056b3;
        }

        td[colspan="8"] {
            text-align: center;
            color: #888;
            font-style: italic;
        }

       
        .no-results {
            text-align: center;
            font-size: 1.2em;
            color: #ff0000;
        }
    </style>
</head>
<body>
    <h2>Kết quả tìm kiếm</h2>
    <form action="search.php" method="get">
        <input type="text" name="search_key" placeholder="Nhập tên hoặc quê quán" value="<?php echo htmlspecialchars($search_key); ?>">
        <button type="submit">Tìm kiếm</button>
    </form>
    <br>

    <?php if (!empty($search_key)): ?>
        <?php if (count($search_results) > 0): ?>
            <table>
                <tr>
                    <th>STT</th>
                    <th>Họ và tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Quê quán</th>
                    <th>Trình độ</th>
                    <th>Nhóm</th>
                </tr>
                <?php foreach ($search_results as $index => $student): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($student['dob']); ?></td>
                        <td><?php echo $student['gender'] ? 'Nam' : 'Nữ'; ?></td>
                        <td><?php echo htmlspecialchars($student['hometown']); ?></td>
                        <td>
                            <?php
                            switch ($student['level']) {
                                case 0: echo 'Tiến sĩ'; break;
                                case 1: echo 'Thạc sĩ'; break;
                                case 2: echo 'Kỹ sư'; break;
                                default: echo 'Khác';
                            }
                            ?>
                        </td>
                        <td><?php echo "Nhóm " . $student['group']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p class="no-results">Không tìm thấy kết quả nào cho từ khóa "<strong><?php echo htmlspecialchars($search_key); ?></strong>".</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
