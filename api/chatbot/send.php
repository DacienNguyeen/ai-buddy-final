<?php
// api/chatbot/send.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');

// Xử lý Preflight request (CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

    require_once __DIR__ . '/../../modules/chatbot/controllers/ChatController.php';

try {
    // 1. Nhận dữ liệu JSON từ JS gửi lên
    $input = json_decode(file_get_contents('php://input'), true);

    // 2. Validate cơ bản
    if (empty($input['user_id']) || empty($input['message'])) {
        throw new Exception('Missing required fields (user_id or message)');
    }

    // 3. Gọi Controller
    $controller = new ChatController();
    $result = $controller->sendMessage(
        $input['user_id'],
        $input['persona_id'] ?? 1, // Mặc định Persona 1 nếu thiếu
        $input['topic_id'] ?? 1,   // Mặc định Topic 1 nếu thiếu
        $input['message'],
        $input['session_id'] ?? null,
        $input['image'] ?? null
    );
    http_response_code($result['status']);

    // 4. Trả kết quả
    echo json_encode($result);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 500, 'message' => $e->getMessage()]);
}
?>