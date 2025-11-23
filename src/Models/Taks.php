<?php

namespace Src\Models;

use Src\Services\Database;
use PDO;

class Task {

    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function create($userId, $title, $description) {
        $stmt = $this->db->prepare("INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $title, $description]);
    }

    public function getByUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $userId, $title, $description) {
        $stmt = $this->db->prepare("UPDATE tasks SET title = ?, description = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
        return $stmt->execute([$title, $description, $id, $userId]);
    }

    public function complete($id, $userId) {
        $stmt = $this->db->prepare("UPDATE tasks SET completed = 1, updated_at = NOW() WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $userId]);
    }

    public function delete($id, $userId) {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $userId]);
    }
}
