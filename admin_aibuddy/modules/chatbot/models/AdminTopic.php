<?php
class AdminTopic {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM topic ORDER BY TopicID DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM topic WHERE TopicID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data) {
        $sql = "INSERT INTO topic (TopicName, Description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $data['TopicName'], $data['Description']);
        $stmt->execute();
    }

    public function update($id, $data) {
        $sql = "UPDATE topic SET TopicName = ?, Description = ? WHERE TopicID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $data['TopicName'], $data['Description'], $id);
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM topic WHERE TopicID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>