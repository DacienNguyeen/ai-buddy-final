<?php
class AdminTopic {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM Topics ORDER BY CreatedAt DESC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Topics WHERE TopicID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO Topics (TopicName, Description) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['TopicName'], $data['Description']]);
    }

    public function update($id, $data) {
        $sql = "UPDATE Topics SET TopicName = ?, Description = ? WHERE TopicID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$data['TopicName'], $data['Description'], $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Topics WHERE TopicID = ?");
        $stmt->execute([$id]);
    }
}
?>