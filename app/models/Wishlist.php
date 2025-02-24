<?php

class Wishlist {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function add($studentId, $internshipId) {
        $sql = "INSERT IGNORE INTO wishlists (student_id, internship_id) VALUES (?, ?)";
        return $this->db->query($sql, [$studentId, $internshipId]);
    }

    public function remove($studentId, $internshipId) {
        $sql = "DELETE FROM wishlists WHERE student_id = ? AND internship_id = ?";
        return $this->db->query($sql, [$studentId, $internshipId]);
    }

    public function getStudentWishlist($studentId) {
        $sql = "SELECT w.*, i.title, i.description, c.name as company_name
                FROM wishlists w
                JOIN internships i ON w.internship_id = i.id
                JOIN companies c ON i.company_id = c.id
                WHERE w.student_id = ?
                ORDER BY w.created_at DESC";
        return $this->db->query($sql, [$studentId])->fetchAll();
    }
}