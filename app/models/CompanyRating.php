<?php

class CompanyRating {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function rate($data) {
        $sql = "INSERT INTO company_ratings (company_id, student_id, rating, comment)
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE rating = ?, comment = ?";
        return $this->db->query($sql, [
            $data['company_id'],
            $data['student_id'],
            $data['rating'],
            $data['comment'],
            $data['rating'],
            $data['comment']
        ]);
    }

    public function getCompanyRatings($companyId) {
        $sql = "SELECT r.*, u.firstname, u.lastname
                FROM company_ratings r
                JOIN users u ON r.student_id = u.id
                WHERE r.company_id = ?
                ORDER BY r.created_at DESC";
        return $this->db->query($sql, [$companyId])->fetchAll();
    }

    public function getAverageRating($companyId) {
        $sql = "SELECT AVG(rating) as average_rating
                FROM company_ratings
                WHERE company_id = ?";
        $result = $this->db->query($sql, [$companyId])->fetch();
        return $result ? $result['average_rating'] : 0;
    }
}