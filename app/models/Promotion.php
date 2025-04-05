<?php

class Promotion {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $sql = "SELECT * FROM promotions ORDER BY name";
        return $this->db->query($sql)->fetchAll();
    }

    public function find($id) {
        $sql = "SELECT * FROM promotions WHERE id = ?";
        return $this->db->query($sql, [$id])->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO promotions (name, year) VALUES (?, ?)";
        return $this->db->query($sql, [
            $data['name'],
            $data['year']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE promotions SET name = ?, year = ? WHERE id = ?";
        return $this->db->query($sql, [
            $data['name'],
            $data['year'],
            $id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM promotions WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }
}