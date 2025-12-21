<?php
class AdminPersona {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM Personas ORDER BY CreatedAt DESC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Personas WHERE PersonaID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO Personas (PersonaName, Description, SystemPrompt, Icon, IsPremium) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['PersonaName'],
            $data['Description'],
            $data['SystemPrompt'],
            $data['Icon'],
            isset($data['IsPremium']) ? 1 : 0
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE Personas SET PersonaName = ?, Description = ?, SystemPrompt = ?, Icon = ?, IsPremium = ? WHERE PersonaID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['PersonaName'],
            $data['Description'],
            $data['SystemPrompt'],
            $data['Icon'],
            isset($data['IsPremium']) ? 1 : 0,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Personas WHERE PersonaID = ?");
        $stmt->execute([$id]);
    }
}
?>