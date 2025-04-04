<?php

class Student {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create($data) {
        $sql = "INSERT INTO users (firstname, lastname, email, password, role_id, promotion_id, created_at) 
                VALUES (?, ?, ?, ?, 3, ?, NOW())"; // role_id 3 pour étudiant
        return $this->db->query($sql, [
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['promotion_id']
        ]);
    }

    public function find($id) {
        $sql = "SELECT u.*, p.name as promotion_name 
                FROM users u 
                LEFT JOIN promotions p ON u.promotion_id = p.id 
                WHERE u.id = ? AND u.role_id = 3";
        $result = $this->db->query($sql, [$id])->fetch();
        return $result ? $result : null;
    }

    public function update($id, $data) {
        $sql = "UPDATE users 
                SET firstname = ?, lastname = ?, email = ?, promotion_id = ? 
                WHERE id = ? AND role_id = 3";
        return $this->db->query($sql, [
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            $data['promotion_id'],
            $id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = ? AND role_id = 3";
        return $this->db->query($sql, [$id]);
    }

    public function search($query = '', $promotionId = null) {
        $params = [];
        $sql = "SELECT u.*, p.name as promotion_name 
                FROM users u 
                LEFT JOIN promotions p ON u.promotion_id = p.id 
                WHERE u.role_id = 3";

        if (!empty($query)) {
            $sql .= " AND (u.firstname LIKE ? OR u.lastname LIKE ? OR u.email LIKE ?)";
            $searchTerm = "%$query%";
            $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm]);
        }

        if ($promotionId) {
            $sql .= " AND u.promotion_id = ?";
            $params[] = $promotionId;
        }

        $sql .= " ORDER BY u.lastname, u.firstname";
        return $this->db->query($sql, $params)->fetchAll();
    }

    public function getAll($promotionId = null) {
        $sql = "SELECT u.*, p.name as promotion_name 
                FROM users u 
                LEFT JOIN promotions p ON u.promotion_id = p.id 
                WHERE u.role_id = 3";
        
        if ($promotionId) {
            $sql .= " AND u.promotion_id = ?";
            return $this->db->query($sql, [$promotionId])->fetchAll();
        }
        
        $sql .= " ORDER BY u.lastname, u.firstname";
        return $this->db->query($sql)->fetchAll();
    }

    public function getAllByPilot($pilotId) {
        $sql = "SELECT u.*, p.name as promotion_name 
                FROM users u 
                LEFT JOIN promotions p ON u.promotion_id = p.id 
                LEFT JOIN pilot_promotions pp ON p.id = pp.promotion_id
                WHERE u.role_id = 3 
                AND pp.pilot_id = ?
                ORDER BY u.lastname, u.firstname";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$pilotId]);
        return $stmt->fetchAll();
    }

    public function getStats() {
        $stats = [];
        
        // Nombre total d'étudiants
        $stats['total'] = $this->db->query(
            "SELECT COUNT(*) as count FROM users WHERE role_id = 3"
        )->fetch()['count'];

        // Étudiants par promotion
        $stats['by_promotion'] = $this->db->query(
            "SELECT p.name, COUNT(u.id) as count 
             FROM promotions p 
             LEFT JOIN users u ON p.id = u.promotion_id AND u.role_id = 3 
             GROUP BY p.id, p.name"
        )->fetchAll();

        // Statistiques des stages
        $stats['internships'] = $this->db->query(
            "SELECT 
                COUNT(DISTINCT s.id) as total_students,
                COUNT(DISTINCT CASE WHEN i.status = 'accepted' THEN s.id END) as with_internship,
                COUNT(DISTINCT CASE WHEN i.status = 'pending' THEN s.id END) as searching
             FROM users s 
             LEFT JOIN internship_applications i ON s.id = i.student_id 
             WHERE s.role_id = 3"
        )->fetch();

        return $stats;
    }
}