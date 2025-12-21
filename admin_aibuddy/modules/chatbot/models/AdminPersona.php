<?php
class AdminPersona {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM persona ORDER BY PersonaID DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM persona WHERE PersonaID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($data) {
        $sql = "INSERT INTO persona (PersonaName, Description, SystemPrompt, Icon, IsPremium) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $isPremium = isset($data['IsPremium']) ? 1 : 0;
        $stmt->bind_param("sssss", $data['PersonaName'], $data['Description'], $data['SystemPrompt'], $data['Icon'], $isPremium);
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            die("Error creating persona: " . $stmt->error);
        }
    }

    public function update($id, $data) {
        $sql = "UPDATE persona SET PersonaName = ?, Description = ?, SystemPrompt = ?, Icon = ?, IsPremium = ? WHERE PersonaID = ?";
        $stmt = $this->conn->prepare($sql);
        $isPremium = isset($data['IsPremium']) ? 1 : 0;
        $stmt->bind_param("sssssi", $data['PersonaName'], $data['Description'], $data['SystemPrompt'], $data['Icon'], $isPremium, $id);
        if (!$stmt->execute()) {
            die("Error updating persona: " . $stmt->error);
        }
    }

    public function delete($id) {
        // First delete related chat history
        $stmt = $this->conn->prepare("DELETE FROM chathistory WHERE PersonaID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Then delete the persona
        $stmt = $this->conn->prepare("DELETE FROM persona WHERE PersonaID = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            die("Error deleting persona: " . $stmt->error);
        }
    }
}
?>