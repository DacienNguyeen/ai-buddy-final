<?php
// api/chatbot/init.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../modules/chatbot/controllers/ChatController.php';

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (empty($input['user_id']) || empty($input['topic_id'])) {
        throw new Exception('Missing required fields');
    }

    $controller = new ChatController();
    
    // Lưu ý: Cần thêm hàm này vào ChatController (xem hướng dẫn bên dưới)
    $result = $controller->initChatWithTopic(
        $input['user_id'],
        $input['persona_id'] ?? 1,
        $input['topic_id']
    );

    echo json_encode($result);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 500, 'message' => $e->getMessage()]);
}
?>