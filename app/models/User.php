<?php
class User {
    private $db;

    public function __construct() {
        $this->db = getPDO();
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND active = '1'");
        $stmt->execute([$email, sha1($password)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser($data) {
        $stmt = $this->db->prepare("INSERT INTO users (name, cc, senescyt, type, email, password, active) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['name'],
            $data['cc'],
            $data['senescyt'],
            $data['type'],
            $data['email'],
            sha1($data['password']),
            $data['active']
        ]);
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $data) {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, cc = ?, senescyt = ?, type = ?, email = ?, active = ? WHERE id = ?");
        $stmt->execute([
            $data['name'],
            $data['cc'],
            $data['senescyt'],
            $data['type'],
            $data['email'],
            $data['active'],
            $id
        ]);
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

}