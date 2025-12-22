<?php
// user_aibuddy/api/chatbot/get_personas.php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
session_start();

// Điều chỉnh đường dẫn đến file config/db.php
require_once '../../config/db.php'; 

$response = ['status' => 400, 'data' => [], 'user_plan' => 1];

try {
    // Kiểm tra đăng nhập
    if (!isset($_SESSION['userid'])) {
        $userId = 0; 
    } else {
        $userId = $_SESSION['userid'];
    }

    // --- 1. LOGIC MỚI: CHECK USER ORDER (THEO YÊU CẦU) ---
    // Mặc định là Free (PlanID = 1)
    $currentPlanId = 1;

    if ($userId > 0) {
        // Tìm đơn hàng thành công mới nhất của User
        $sqlOrder = "SELECT PlanID 
                     FROM userorder 
                     WHERE UserID = ? AND OrderStatus = 'Completed' 
                     ORDER BY PurchaseTime DESC 
                     LIMIT 1";
                    
        $stmt = $conn->prepare($sqlOrder);
        
        if ($stmt) {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            
            if ($res) {
                // Nếu tìm thấy đơn hàng completed, lấy PlanID đó làm plan hiện tại
                $currentPlanId = (int)$res['PlanID'];
            }
            $stmt->close();
        }
    }

    // Xác định quyền VIP: PlanID >= 2 (Essential hoặc Premium) là VIP
    $isVipUser = ($currentPlanId >= 2);

    // --- 2. LẤY DANH SÁCH PERSONA VÀ KHÓA NẾU CẦN ---
    $sql = "SELECT PersonaID, PersonaName, Description, Icon, IsPremium FROM persona";
    $result = $conn->query($sql);

    $personas = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Xử lý icon mặc định nếu chưa có
            if (empty($row['Icon'])) $row['Icon'] = '🤖';

            // --- LOGIC LOCK ---
            $isLocked = false;
            
            // Nếu Persona là Premium (IsPremium = 1) 
            // VÀ User KHÔNG PHẢI VIP (đang dùng gói Free) -> Thì KHÓA
            if ($row['IsPremium'] == 1 && !$isVipUser) {
                $isLocked = true;
            }

            $row['is_locked'] = $isLocked; 
            $personas[] = $row;
        }
    }

    echo json_encode([
        'status' => 200, 
        'data' => $personas,
        'user_plan' => $currentPlanId, // Trả về PlanID để JS xử lý UI khác
        'is_vip' => $isVipUser
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 500, 'message' => $e->getMessage()]);
}
?>