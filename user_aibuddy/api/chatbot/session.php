<?php
// api/chatbot/session.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, DELETE, PUT, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../../modules/chatbot/controllers/ChatController.php';

try {
    $controller = new ChatController();
    $input = json_decode(file_get_contents('php://input'), true);
    $method = $_SERVER['REQUEST_METHOD'];

    // Xử lý XÓA
    if ($method === 'DELETE' || ($method === 'POST' && isset($input['action']) && $input['action'] === 'delete')) {
        if (empty($input['session_id']) || empty($input['user_id'])) throw new Exception("Missing params for delete");
        
        $result = $controller->deleteSession($input['session_id'], $input['user_id']);
        echo json_encode($result);
    } 
    // Xử lý ĐỔI TÊN
    elseif ($method === 'PUT' || ($method === 'POST' && isset($input['action']) && $input['action'] === 'rename')) {
        if (empty($input['session_id']) || empty($input['user_id']) || empty($input['title'])) throw new Exception("Missing params for rename");

        $result = $controller->renameSession($input['session_id'], $input['user_id'], $input['title']);
        echo json_encode($result);
    } 
    else {
        throw new Exception("Method not supported or missing action");
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 500, 'message' => $e->getMessage()]);
}
?>