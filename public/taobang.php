<?php
require_once __DIR__ . '/../src/db.php';
$thongbao = "";

try {
    $pdo = getDbConnection();
    $sql = "
    CREATE TABLE IF NOT EXISTS masv_sinhvien (
        id INT AUTO_INCREMENT PRIMARY KEY,
        masv VARCHAR(50) NOT NULL,
        hoten VARCHAR(100) NOT NULL,
        namsinh INT NOT NULL,
        dienthoai VARCHAR(20) NOT NULL,
        email VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    $pdo->exec($sql);
    $thongbao = "Tạo bảng dữ liệu thành công!";
} catch (PDOException $e) {
    $thongbao = "Tạo bảng dữ liệu thất bại: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Tạo bảng</title></head>
<body style="font-family: Arial; margin: 40px;">
    <h2>Tạo bảng dữ liệu</h2>
    <p style="color: green; font-weight: bold;"><?= $thongbao ?></p>
    <p><a href="index.php">Quay về trang chủ</a></p>
</body>
</html>
3. Tập tin public/themsv.php (Form thêm sinh viên)
PHP
<?php
require_once __DIR__ . '/../src/db.php';
$thongbao = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO masv_sinhvien (masv, hoten, namsinh, dienthoai, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['masv'],
            $_POST['hoten'],
            $_POST['namsinh'],
            $_POST['dienthoai'],
            $_POST['email']
        ]);
        $thongbao = "Thêm sinh viên thành công!";
    } catch (PDOException $e) {
        $thongbao = "Thêm sinh viên thất bại: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Thêm sinh viên</title></head>
<body style="font-family: Arial; margin: 40px;">
    <h2>Thêm sinh viên mới</h2>
    <?php if(!empty($thongbao)): ?>
        <p style="font-weight: bold; color: <?= strpos($thongbao, 'thành công') !== false ? 'green' : 'red' ?>;"><?= $thongbao ?></p>
    <?php endif; ?>
    
    <form method="POST">
        <label>Mã sinh viên:</label><br><input type="text" name="masv" required><br><br>
        <label>Họ tên:</label><br><input type="text" name="hoten" required><br><br>
        <label>Năm sinh:</label><br><input type="number" name="namsinh" required><br><br>
        <label>Điện thoại:</label><br><input type="text" name="dienthoai" required><br><br>
        <label>Email:</label><br><input type="email" name="email" required><br><br>
        <button type="submit">Thêm sinh viên</button>
    </form>
    <p><a href="index.php">Quay về trang chủ</a></p>
</body>
</html>
