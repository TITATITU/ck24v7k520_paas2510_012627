<?php
// Thay đổi thông tin sinh viên của bạn vào đây
$hoten = "Lê Chung Tình";
$masv = "DC24V7K033";
$stt = "01";
$lop = "DC24V7K2";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Quản lý sinh viên</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 40px;">
    <h2>Kiểm tra PaaS, ngày 25/10/2026 - Học kỳ 1 - 20262027</h2>
    <p><b>Họ tên sinh viên:</b> <?= $hoten ?> &nbsp;&nbsp;&nbsp; <b>Mã sinh viên:</b> <?= $masv ?></p>
    <p><b>Thực hành buổi 6 - Platform.sh, stt trong danh sách:</b> <?= $stt ?>, <b>Lớp:</b> <?= $lop ?></p>
    
    <hr>
    <h3>Menu chứa liên kết đến các tập tin PHP</h3>
    <ul>
        <li><a href="taobang.php">Tạo bảng dữ liệu</a></li>
        <li><a href="themsv.php">Thêm sinh viên</a></li>
        <li><a href="lietkesv.php">Liệt kê danh sách</a></li>
        <li><a href="suathongtin.php">Cập nhật thông tin sinh viên</a></li>
    </ul>
</body>
</html>
