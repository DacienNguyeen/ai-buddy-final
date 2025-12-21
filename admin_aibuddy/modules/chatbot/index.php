<?php
// ================================================================
// MODULE: CHATBOT MANAGER - LIST
// File: modules/chatbot/index.php
// ================================================================
session_start();

// 1. KẾT NỐI DATABASE (Đi ngược ra 2 cấp thư mục)
require_once __DIR__ . '/../../config/db.php';

// 2. KIỂM TRA ĐĂNG NHẬP
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit();
}

// 3. XỬ LÝ XÓA TIN NHẮN
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    // Xóa dựa trên ChatID (Primary Key của bảng chathistory)
    $conn->query("DELETE FROM chathistory WHERE ChatID = $id");
    // Refresh lại trang để mất dòng đã xóa
    header("Location: index.php"); 
    exit();
}

// 4. XỬ LÝ TÌM KIẾM
$search = "";
$where = "";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $search_safe = $conn->real_escape_string($search);
    
    // Logic tìm kiếm: Tìm theo Nội dung tin nhắn hoặc UserID
    if (is_numeric($search)) {
        // Nếu là số, ưu tiên tìm theo UserID hoặc TopicID
        $where = "WHERE UserID = $search_safe OR TopicID = $search_safe";
    } else {
        // Nếu là chữ, tìm trong nội dung tin nhắn
        $where = "WHERE MessageContent LIKE '%$search_safe%'";
    }
}

// Query lấy danh sách (Sắp xếp mới nhất lên đầu)
$sql = "SELECT * FROM chathistory $where ORDER BY ChatTime DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Chatbot</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php include __DIR__ . '/../../includes/sidebar.php'; ?>

    <div class="top-navbar">
        <h2>Quản lý Chatbot</h2>
        <div class="user-profile">
            <span>Xin chào, <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Admin'; ?></span>
        </div>
    </div>

    <div class="main-content">
        
        <div class="card-box" style="margin-bottom: 20px;">
            <form method="GET" style="display: flex; gap: 10px;">
                <input type="text" name="search" class="form-control" style="flex: 1; padding: 10px;" 
                       placeholder="Nhập nội dung tin nhắn hoặc UserID..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary" style="background: var(--primary); color: white; border: none; padding: 0 20px; border-radius: 5px; cursor: pointer;">
                    <i class="fa-solid fa-magnifying-glass"></i> Tìm
                </button>
                <?php if($search): ?>
                    <a href="index.php" class="btn" style="background: #999; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">Xóa lọc</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="table-container card-box" style="padding: 0;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: var(--primary); color: white;">
                        <th style="padding: 15px;">ID</th>
                        <th style="padding: 15px;">User ID</th>
                        <th style="padding: 15px;">Topic ID</th>
                        <th style="padding: 15px;">Thời gian</th>
                        <th style="padding: 15px; width: 40%;">Nội dung tin nhắn</th>
                        <th style="padding: 15px; text-align: center;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 15px;">#<?php echo $row['ChatID']; ?></td>
                                
                                <td style="padding: 15px; font-weight: bold; color: var(--primary);">
                                    <?php echo $row['UserID']; ?>
                                </td>
                                
                                <td style="padding: 15px;"><?php echo $row['TopicID']; ?></td>
                                
                                <td style="padding: 15px;">
                                    <?php echo date('d/m/Y H:i', strtotime($row['ChatTime'])); ?>
                                </td>
                                
                                <td style="padding: 15px; color: #555;">
                                    <?php echo htmlspecialchars($row['MessageContent']); ?>
                                </td>
                                
                                <td style="padding: 15px; text-align: center;">
                                    <a href="index.php?delete_id=<?php echo $row['ChatID']; ?>" 
                                       onclick="return confirm('Bạn có chắc muốn xóa tin nhắn này?');" 
                                       style="color: #e74c3c; font-size: 18px;" 
                                       title="Xóa tin nhắn">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #999;">Không tìm thấy dữ liệu tin nhắn nào</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
<div style="margin-bottom: 15px; text-align: center;">
    <a href="persona.php" class="btn" style="background: #27ae60; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
        <i class="fa-solid fa-masks-theater"></i> Quản lý Persona
    </a>
</div>
</body>
</html>