<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'qlsv_nguyenngoclinh') or die('Xin lỗi, database không kết nối được.');


$conn->query("SET NAMES 'utf8'"); 
$conn->query("SET CHARACTER SET utf8");  
$conn->query("SET SESSION collation_connection = 'utf8_unicode_ci'");