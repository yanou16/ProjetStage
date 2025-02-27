<?php

class Company extends Model {
    public function __construct() {
        parent::__construct();
        
        // Ajouter les colonnes manquantes si elles n'existent pas
        $this->addMissingColumns();
    }

    private function addMissingColumns() {
        $sql = "
            ALTER TABLE companies 
            ADD COLUMN IF NOT EXISTS address VARCHAR(255) NULL,
            ADD COLUMN IF NOT EXISTS city VARCHAR(100) NULL,
            ADD COLUMN IF NOT EXISTS country VARCHAR(2) NULL,
            ADD COLUMN IF NOT EXISTS industry VARCHAR(50) NULL,
            ADD COLUMN IF NOT EXISTS email VARCHAR(255) NULL,
            ADD COLUMN IF NOT EXISTS phone VARCHAR(20) NULL,
            ADD COLUMN IF NOT EXISTS website VARCHAR(255) NULL
        ";
        $this->db->exec($sql);
    }

    public function create($data) {
        $sql = "INSERT INTO companies (
            name, address, city, country, industry, description, 
            email, phone, website, created_at
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()
        )";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['address'] ?? null,
            $data['city'] ?? null,
            $data['country'] ?? null,
            $data['industry'],
            $data['description'],
            $data['email'] ?? null,
            $data['phone'] ?? null,
            $data['website'] ?? null
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE companies 
                SET name = ?, address = ?, city = ?, country = ?, 
                    industry = ?, description = ?, email = ?, 
                    phone = ?, website = ?, updated_at = NOW() 
                WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['address'] ?? null,
            $data['city'] ?? null,
            $data['country'] ?? null,
            $data['industry'],
            $data['description'],
            $data['email'] ?? null,
            $data['phone'] ?? null,
            $data['website'] ?? null,
            $id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM companies WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function find($id) {
        $sql = "SELECT * FROM companies WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $sql = "SELECT * FROM companies WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAll() {
        $sql = "SELECT c.*, 
                (SELECT AVG(rating) FROM company_ratings WHERE company_id = c.id) as rating
            FROM companies c 
            ORDER BY c.name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function search($query) {
        $sql = "SELECT * FROM companies 
                WHERE name LIKE ? OR industry LIKE ? OR description LIKE ?";
        
        $searchTerm = "%{$query}%";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }

    public function rate($companyId, $userId, $rating, $comment) {
        $sql = "INSERT INTO company_ratings (company_id, user_id, rating, comment, created_at) 
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$companyId, $userId, $rating, $comment]);
    }

    public function getStats() {
        $stats = [];
        
        // Nombre total d'entreprises
        $sql = "SELECT COUNT(*) as count FROM companies";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['total'] = $stmt->fetch()['count'];
        
        // Entreprises par ville
        $sql = "SELECT industry, COUNT(*) as count 
                FROM companies 
                GROUP BY industry 
                ORDER BY count DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['by_industry'] = $stmt->fetchAll();
        
        // Moyenne des évaluations
        $sql = "SELECT AVG(rating) as avg_rating 
                FROM company_ratings";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['avg_rating'] = $stmt->fetch()['avg_rating'];
        
        return $stats;
    }

    public function getInternshipsByCompany($companyId) {
        $sql = "SELECT i.*, c.name as company_name 
                FROM internships i 
                JOIN companies c ON i.company_id = c.id 
                WHERE i.company_id = ? 
                ORDER BY i.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$companyId]);
        return $stmt->fetchAll();
    }

    public function count() {
        $sql = "SELECT COUNT(*) as total FROM companies";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    public function countInternships() {
        $sql = "SELECT COUNT(*) as total FROM internships";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    public function getSectorStats() {
        $sql = "SELECT 
                industry,
                COUNT(*) as count,
                (COUNT(*) * 100.0 / (SELECT COUNT(*) FROM companies)) as percentage
                FROM companies 
                WHERE industry IS NOT NULL 
                GROUP BY industry 
                ORDER BY count DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTopCompaniesByInternships() {
        $sql = "SELECT 
                c.id,
                c.name,
                c.industry,
                COUNT(i.id) as internship_count,
                MAX(i.created_at) as last_internship_date
                FROM companies c
                LEFT JOIN internships i ON c.id = i.company_id
                GROUP BY c.id, c.name, c.industry
                HAVING internship_count > 0
                ORDER BY internship_count DESC
                LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}