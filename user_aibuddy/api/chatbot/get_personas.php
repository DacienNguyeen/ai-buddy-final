<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
session_start();

// Điều chỉnh đường dẫn đến file db.php cho đúng với cấu trúc thư mục của bạn
// user_aibuddy/api/chatbot/ -> lùi 2 cấp ra user_aibuddy -> vào config/db.php
require_once '../../config/db.php'; 

$response = ['status' => 400, 'data' => [], 'message' => ''];

try {
    if (!isset($_SESSION['userid'])) {
        throw new Exception("User not logged in");
    }

    $userId = $_SESSION['userid'];

    // 1. LẤY PLAN ID CỦA USER (SỬA LẠI QUERY ĐÚNG)
    // Kiểm tra trong bảng membership xem user đang dùng gói nào
    // Lấy gói mới nhất (MembershipID lớn nhất) và còn hạn (nếu có check date)
    $planSql = "SELECT PlanID, MembershipStatus FROM membership WHERE UserID = ? ORDER BY MembershipID DESC LIMIT 1";
    
    $stmt = $conn->prepare($planSql);
    if (!$stmt) {
        throw new Exception("Database Prepare Error: " . $conn->error);
    }
    
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $planRes = $stmt->get_result()->fetch_assoc();

    // Mặc định là gói Free (ID = 1) nếu không tìm thấy membership
    $userPlanID = 1;
    if ($planRes && isset($planRes['PlanID'])) {
        $userPlanID = (int)$planRes['PlanID'];
        
        // Nếu membership bị Cancelled hoặc Expired thì quay về Free (tuỳ logic của bạn)
        // Ví dụ: if ($planRes['MembershipStatus'] !== 'Active') $userPlanID = 1;
    }

    // Logic: User là Free nếu PlanID <= 1
    $isFreeUser = ($userPlanID <= 1);

    // 2. LẤY DANH SÁCH PERSONA
    // Đảm bảo bảng persona đã chạy lệnh SQL thêm cột IsPremium, Icon từ aibuddy_database_chatbot.sql
    $sql = "SELECT PersonaID, PersonaName, Description, Icon, IsPremium FROM persona";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query Persona Error: " . $conn->error);
    }

    $personas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Xử lý icon mặc định nếu null
            if (empty($row['Icon'])) $row['Icon'] = '🤖';

            // Logic khóa: Khóa nếu Persona Premium mà User lại dùng Free
            $isLocked = false;
            // Ép kiểu về int để so sánh cho chuẩn
            if ((int)$row['IsPremium'] == 1 && $isFreeUser) {
                $isLocked = true;
            }

            $row['is_locked'] = $isLocked; 
            $personas[] = $row;
        }
    }

    echo json_encode(['status' => 200, 'data' => $personas]);

} catch (Exception $e) {
    // Trả về JSON lỗi thay vì HTML để JS không bị crash
    http_response_code(500);
    echo json_encode(['status' => 500, 'message' => $e->getMessage()]);
}
?>