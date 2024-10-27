<?php
class Service {
    private $db;

    public function __construct() {
        $this->db = getPDO();
    }

    public function getAllServices() {
        $stmt = $this->db->query("SELECT * FROM services");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createService($data) {
        $stmt = $this->db->prepare("INSERT INTO services (name, description, price) VALUES (?, ?, ?)");
        $stmt->execute([$data['name'], $data['description'], $data['price']]);
    }

    public function getServiceById($id) {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateService($id, $data) {
        $stmt = $this->db->prepare("UPDATE services SET name = ?, description = ?, price = ? WHERE id = ?");
        $stmt->execute([$data['name'], $data['description'], $data['price'], $id]);
    }

    public function deleteService($id) {
        $stmt = $this->db->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$id]);
    }
}