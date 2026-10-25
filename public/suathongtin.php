<?php
require_once __DIR__ . '/../src/db.php';
$pdo = getDbConnection();
$thongbao = "";
$sv = null;

$masv_input = $_GET['masv'] ?? $_POST['search_masv'] ?? '';

if (!empty($masv_input)) {
    $stmt = $pdo->prepare("SELECT * FROM masv_sinhvien WHERE masv = ?");
    $stmt->execute([$masv_input]);
    $sv = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_sv'])) {
    try {
        $stmt = $pdo->prepare("UPDATE masv_sinhvien SET hoten = ?, namsinh = ?, dienthoai = ?, email = ? WHERE masv = ?");
        $stmt->execute([
            $_POST['hoten'],
            $_POST['namsinh'],
            $_POST['dienthoai'],
            $_POST['email'],
            $_POST['masv']
        ]);
        $thongbao = "Cập nhật thông tin thành công!";
        // Load lại dữ liệu mới
        $stmt = $pdo->prepare("SELECT * FROM masv_sinhvien WHERE masv = ?");
        $stmt->execute([$_POST['masv']]);
        $sv = $stmt->fetch();
    } catch (PDOException $e) {
        $thongbao = "Cập nhật thất bại: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><meta charset="UTF-8"><title>Cập nhật sinh viên</title></head>
<body style="font-family: Arial; margin: 40px;">
    <h2>Cập nhật thông tin sinh viên</h2>
    
    <form method="GET">
        <label>Nhập Mã SV cần sửa:</label>
        <input type="text" name="masv" value="<?= htmlspecialchars($masv_input) ?>" required>
        <button type="submit">Tìm kiếm</button>
    </form>
    <hr>

    <?php if(!empty($thongbao)): ?>
        <p style="font-weight: bold; color: green;"><?= $thongbao ?></p>
    <?php endif; ?>

    <?php if($sv): ?>
    <form method="POST">
        <input type="hidden" name="masv" value="<?= htmlspecialchars($sv['masv']) ?>">
        <p><b>Mã SV:</b> <?= htmlspecialchars($sv['masv']) ?></p>
        <label>Họ tên:</label><br><input type="text" name="hoten" value="<?= htmlspecialchars($sv['hoten']) ?>" required><br><br>
        <label>Năm sinh:</label><br><input type="number" name="namsinh" value="<?= $sv['namsinh'] ?>" required><br><br>
        <label>Điện thoại:</label><br><input type="text" name="dienthoai" value="<?= htmlspecialchars($sv['dienthoai']) ?>" required><br><br>
        <label>Email:</label><br><input type="email" name="email" value="<?= htmlspecialchars($sv['email']) ?>" required><br><br>
        <button type="submit" name="update_sv">Lưu thay đổi</button>
    </form>
    <?php elseif(!empty($masv_input)): ?>
        <p style="color: red;">Không tìm thấy sinh viên với mã: <?= htmlspecialchars($masv_input) ?></p>
    <?php endif; ?>

    <p><a href="lietkesv.php">Xem danh sách sinh viên</a> | <a href="index.php">Quay về trang chủ</a></p>
</body>
</html>
