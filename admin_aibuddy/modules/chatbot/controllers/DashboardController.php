<?php
// modules/admin/controllers/DashboardController.php
require_once __DIR__ . '/../../../config/database.php';

class DashboardController {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getStats() {
        return [
            'users' => $this->countTable('Users'),
            'sessions' => $this->countTable('ChatSessions'),
            'personas' => $this->countTable('Personas'),
            'topics' => $this->countTable('Topics')
        ];
    }

    private function countTable($tableName) {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM $tableName");
        return $stmt->fetchColumn();
    }
}
?>