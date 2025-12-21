<?php
// api/chatbot/history.php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../modules/chatbot/controllers/ChatController.php';

try {
    $userId = $_GET['user_id'] ?? 1; // Mặc định user 1 nếu không truyền

    $controller = new ChatController();
    $history = $controller->getUserHistory($userId);

    echo json_encode([
        'status' => 200, 
        'data' => $history
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 500, 'message' => $e->getMessage()]);
}
?>