<?php

use src\Services\Database;

class User {

    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }
    
    public function create($name, $email, $password) {
        $stmt = $this->db->prepare("INSER INTO users (name, email, password) values (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    
}