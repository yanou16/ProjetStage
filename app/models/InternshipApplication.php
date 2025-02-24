<?php

class InternshipApplication {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create($data) {
        $sql = "INSERT INTO internship_applications (
                    student_id, internship_id, motivation_letter, 
                    cv_path, status
                ) VALUES (?, ?, ?, ?, 'pending')";
        return $this->db->query($sql, [
            $data['student_id'],
            $data['internship_id'],
            $data['motivation_letter'],
            $data['cv_path']
        ]);
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE internship_applications SET status = ? WHERE id = ?";
        return $this->db->query($sql, [$status, $id]);
    }

    public function getStudentApplications($studentId) {
        $sql = "SELECT a.*, i.title, i.company_id, c.name as company_name 
                FROM internship_applications a
                JOIN internships i ON a.internship_id = i.id
                JOIN companies c ON i.company_id = c.id
                WHERE a.student_id = ?
                ORDER BY a.created_at DESC";
        return $this->db->query($sql, [$studentId])->fetchAll();
    }
}