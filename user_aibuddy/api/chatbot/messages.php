<?php
// api/chatbot/messages.php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../modules/chatbot/controllers/ChatController.php';

try {
    $userId = $_GET['user_id'] ?? 1;
    $sessionId = $_GET['session_id'] ?? null;

    if (!$sessionId) {
        throw new Exception('Missing session_id');
    }

    $controller = new ChatController();
    $result = $controller->getSessionMessages($sessionId, $userId);

    echo json_encode($result);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 500, 'message' => $e->getMessage()]);
}
?>