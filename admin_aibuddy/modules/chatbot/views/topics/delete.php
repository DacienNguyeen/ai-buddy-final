<?php
require_once __DIR__ . '/../../controllers/TopicController.php';
$controller = new TopicController();

if (isset($_GET['id'])) {
    $controller->delete($_GET['id']);
} else {
    header('Location: index.php');
}
?>