<?php

class Pilot {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create($data) {
        $sql = "INSERT INTO users (firstname, lastname, email, password, role_id, created_at) 
                VALUES (?, ?, ?, ?, 2, NOW())"; // role_id 2 pour pilote
        return $this->db->query($sql, [
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE id = ? AND role_id = 2";
        return $this->db->query($sql, [
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            $id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = ? AND role_id = 2";
        return $this->db->query($sql, [$id]);
    }

    public function find($id) {
        $sql = "SELECT * FROM users WHERE id = ? AND role_id = 2";
        return $this->db->query($sql, [$id])->fetch();
    }

    public function search($query) {
        $sql = "SELECT * FROM users 
                WHERE role_id = 2 
                AND (firstname LIKE ? OR lastname LIKE ? OR email LIKE ?)";
        $searchTerm = "%$query%";
        return $this->db->query($sql, [$searchTerm, $searchTerm, $searchTerm])->fetchAll();
    }

    public function getAll() {
        try {
            $sql = "SELECT id, firstname, lastname, email, created_at 
                    FROM users 
                    WHERE role_id = 2 
                    ORDER BY lastname, firstname";
            $result = $this->db->query($sql)->fetchAll();
            return $result ?: [];
        } catch (Exception $e) {
            error_log("Erreur dans Pilot::getAll() : " . $e->getMessage());
            return [];
        }
    }
}