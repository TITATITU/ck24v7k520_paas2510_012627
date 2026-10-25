<?php
require_once __DIR__ . '/../src/db.php';
$pdo = getDbConnection();
$students = $pdo->query("SELECT * FROM masv_sinhvien ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Liệt kê sinh viên</title></head>
<body style="font-family: Arial; margin: 40px;">
    <h2>Danh sách sinh viên</h2>
    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <tr style="background: #f2f2f2;">
            <th>ID</th>
            <th>Mã SV</th>
            <th>Họ tên</th>
            <th>Năm sinh</th>
            <th>Điện thoại</th>
            <th>Email</th>
            <th>Thao tác</th>
        </tr>
        <?php if(empty($students)): ?>
            <tr><td colspan="7" style="text-align: center;">Chưa có dữ liệu sinh viên.</td></tr>
        <?php else: ?>
            <?php foreach($students as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= htmlspecialchars($s['masv']) ?></td>
                <td><?= htmlspecialchars($s['hoten']) ?></td>
                <td><?= $s['namsinh'] ?></td>
                <td><?= htmlspecialchars($s['dienthoai']) ?></td>
                <td><?= htmlspecialchars($s['email']) ?></td>
                <td><a href="suathongtin.php?masv=<?= $s['masv'] ?>">Sửa</a></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <p><a href="index.php">Quay về trang chủ</a></p>
</body>
</html>
