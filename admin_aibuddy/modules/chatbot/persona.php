<?php
// ================================================================
// MODULE: CHATBOT PERSONA MANAGER
// File: modules/chatbot/persona.php
// Table: persona (PersonalID, PersonaName, PersonaDescription, PersonalityTraits)
// ================================================================
session_start();
require_once __DIR__ . '/../../config/db.php';

// 1. KIỂM TRA ĐĂNG NHẬP
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

// Khởi tạo biến
$pName = "";
$pDesc = "";
$pTraits = "";
$edit_mode = false;
$edit_id = 0;
$msg = "";

// 2. XỬ LÝ FORM (THÊM MỚI / CẬP NHẬT)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pName = $conn->real_escape_string($_POST['PersonaName']);
    $pDesc = $conn->real_escape_string($_POST['PersonaDescription']);
    $pTraits = $conn->real_escape_string($_POST['PersonalityTraits']);

    if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
        // --- CẬP NHẬT ---
        $id = intval($_POST['edit_id']);
        $sql = "UPDATE persona SET 
                PersonaName='$pName', 
                PersonaDescription='$pDesc', 
                PersonalityTraits='$pTraits' 
                WHERE PersonaID=$id";
        if ($conn->query($sql)) {
            echo "<script>alert('Cập nhật thành công!'); window.location.href='persona.php';</script>";
        } else {
            $msg = "Lỗi: " . $conn->error;
        }
    } else {
        // --- THÊM MỚI ---
        $sql = "INSERT INTO persona (PersonaName, PersonaDescription, PersonalityTraits) 
                VALUES ('$pName', '$pDesc', '$pTraits')";
        if ($conn->query($sql)) {
            echo "<script>alert('Thêm mới thành công!'); window.location.href='persona.php';</script>";
        } else {
            $msg = "Lỗi: " . $conn->error;
        }
    }
}

// 3. XỬ LÝ XÓA
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    // Kiểm tra xem Persona này có đang được dùng trong lịch sử chat không
    $check = $conn->query("SELECT ChatID FROM chathistory WHERE PersonaID = $id LIMIT 1");
    if ($check->num_rows > 0) {
        echo "<script>alert('Không thể xóa! Persona này đang được sử dụng trong lịch sử chat.'); window.location.href='persona.php';</script>";
    } else {
        $conn->query("DELETE FROM persona WHERE PersonaID = $id");
        header("Location: persona.php");
        exit();
    }
}

// 4. LẤY DỮ LIỆU ĐỂ SỬA
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $res = $conn->query("SELECT * FROM persona WHERE PersonaID = $edit_id");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $pName = $row['PersonaName'];
        $pDesc = $row['PersonaDescription'];
        $pTraits = $row['PersonalityTraits'];
        $edit_mode = true;
    }
}

// 5. LẤY DANH SÁCH
$list_result = $conn->query("SELECT * FROM persona ORDER BY PersonaID DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Persona</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php include __DIR__ . '/../../includes/sidebar.php'; ?>

    <div class="top-navbar">
        <h2>Cấu hình Persona (Nhân vật AI)</h2>
        <div class="user-profile">
            <span>Xin chào, <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Admin'; ?></span>
        </div>
    </div>

    <div class="main-content">
        
        <div style="margin-bottom: 20px;">
            <a href="index.php" style="color: #666; text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> Quay lại Lịch sử Chat
            </a>
        </div>

        <?php if ($msg): ?>
            <div style="padding: 15px; background: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 20px;">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>

        <div class="card-box" style="margin-bottom: 30px;">
            <h3 style="margin-top: 0; color: var(--primary); border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <?php echo $edit_mode ? '✏️ Cập nhật Persona' : '➕ Thêm Persona Mới'; ?>
            </h3>
            
            <form method="POST" action="">
                <?php if ($edit_mode): ?>
                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                <?php endif; ?>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: bold; display: block; margin-bottom: 5px;">Tên hiển thị (PersonaName):</label>
                        <input type="text" name="PersonaName" class="form-control" required 
                               value="<?php echo htmlspecialchars($pName); ?>" 
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                               placeholder="Ví dụ: Trợ lý Thân thiện">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="font-weight: bold; display: block; margin-bottom: 5px;">Tính cách (PersonalityTraits):</label>
                        <input type="text" name="PersonalityTraits" class="form-control" required
                               value="<?php echo htmlspecialchars($pTraits); ?>"
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                               placeholder="Ví dụ: Vui vẻ, Nhiệt tình, Chu đáo...">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Mô tả (PersonaDescription):</label>
                    <textarea name="PersonaDescription" rows="3" class="form-control"
                              style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;"
                              placeholder="Mô tả vai trò của chatbot..."><?php echo htmlspecialchars($pDesc); ?></textarea>
                </div>

                <div>
                    <button type="submit" class="btn" style="background: var(--primary); color: white; border: none; padding: 10px 25px; border-radius: 5px; cursor: pointer;">
                        <i class="fa-solid fa-save"></i> <?php echo $edit_mode ? 'Lưu thay đổi' : 'Tạo mới'; ?>
                    </button>
                    <?php if ($edit_mode): ?>
                        <a href="persona.php" class="btn" style="background: #95a5a6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-left: 10px;">Hủy</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="table-container card-box" style="padding: 0;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: var(--primary); color: white;">
                        <th style="padding: 15px; width: 5%;">ID</th>
                        <th style="padding: 15px; width: 20%;">Tên Persona</th>
                        <th style="padding: 15px; width: 30%;">Mô tả</th>
                        <th style="padding: 15px; width: 30%;">Tính cách (Traits)</th>
                        <th style="padding: 15px; text-align: center;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($list_result && $list_result->num_rows > 0): ?>
                        <?php while($row = $list_result->fetch_assoc()): ?>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 15px; text-align: center;">#<?php echo $row['PersonaID']; ?></td>
                                <td style="padding: 15px; font-weight: bold; color: var(--primary);">
                                    <?php echo htmlspecialchars($row['PersonaName']); ?>
                                </td>
                                <td style="padding: 15px; color: #555;">
                                    <?php echo htmlspecialchars($row['PersonaDescription']); ?>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #e1f5fe; color: #0288d1; padding: 3px 8px; border-radius: 4px; font-size: 13px;">
                                        <?php echo htmlspecialchars($row['PersonalityTraits']); ?>
                                    </span>
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <a href="persona.php?edit_id=<?php echo $row['PersonaID']; ?>" style="color: #f39c12; margin-right: 15px; font-size: 18px;" title="Sửa">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="persona.php?delete_id=<?php echo $row['PersonaID']; ?>" 
                                       onclick="return confirm('Bạn có chắc muốn xóa Persona này?');" 
                                       style="color: #e74c3c; font-size: 18px;" title="Xóa">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="padding: 30px; text-align: center; color: #999;">Chưa có dữ liệu</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>