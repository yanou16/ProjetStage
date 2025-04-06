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
        try {
            $this->db->beginTransaction();

            // Vérifier si l'entreprise existe avant de la supprimer
            $company = $this->find($id);
            if (!$company) {
                throw new Exception("L'entreprise avec l'ID $id n'existe pas.");
            }

            try {
                // 1. Supprimer les candidatures aux stages
                $sql = "DELETE FROM internship_applications 
                        WHERE internship_id IN (
                            SELECT id FROM internships 
                            WHERE company_id = ?
                        )";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$id]);
                error_log("1. Candidatures supprimées pour l'entreprise $id");

                // 2. Supprimer les compétences des stages
                $sql = "DELETE FROM internship_skills 
                        WHERE internship_id IN (
                            SELECT id FROM internships 
                            WHERE company_id = ?
                        )";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$id]);
                error_log("2. Compétences des stages supprimées pour l'entreprise $id");

                // 3. Supprimer les stages
                $sql = "DELETE FROM internships WHERE company_id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$id]);
                error_log("3. Stages supprimés pour l'entreprise $id");

                // 4. Supprimer les évaluations
                $sql = "DELETE FROM company_ratings WHERE company_id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$id]);
                error_log("4. Évaluations supprimées pour l'entreprise $id");

                // 5. Finalement, supprimer l'entreprise
                $sql = "DELETE FROM companies WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$id]);
                error_log("5. Entreprise $id supprimée avec succès");

                $this->db->commit();
                return true;

            } catch (PDOException $e) {
                $this->db->rollBack();
                
                // Log détaillé de l'erreur
                error_log("=== ERREUR DE SUPPRESSION DÉTAILLÉE ===");
                error_log("Entreprise ID: " . $id);
                error_log("Code erreur SQL: " . $e->getCode());
                error_log("Message erreur SQL: " . $e->getMessage());
                error_log("Table en erreur: " . $this->getTableFromError($e->getMessage()));
                error_log("Trace: " . $e->getTraceAsString());
                
                // Vérifier les données liées
                $this->checkLinkedData($id);
                
                throw new Exception(
                    "Erreur détaillée lors de la suppression :\n" .
                    "Code: " . $e->getCode() . "\n" .
                    "Message: " . $e->getMessage() . "\n" .
                    "Table: " . $this->getTableFromError($e->getMessage())
                );
            }

        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }
    }

    private function getTableFromError($errorMessage) {
        // Extraire le nom de la table à partir du message d'erreur
        if (preg_match('/`([^`]+)`/', $errorMessage, $matches)) {
            return $matches[1];
        }
        return "Table inconnue";
    }

    private function checkLinkedData($companyId) {
        $tables = [
            'internship_applications' => "SELECT COUNT(*) FROM internship_applications WHERE internship_id IN (SELECT id FROM internships WHERE company_id = ?)",
            'internship_skills' => "SELECT COUNT(*) FROM internship_skills WHERE internship_id IN (SELECT id FROM internships WHERE company_id = ?)",
            'internships' => "SELECT COUNT(*) FROM internships WHERE company_id = ?",
            'company_ratings' => "SELECT COUNT(*) FROM company_ratings WHERE company_id = ?"
        ];

        error_log("=== VÉRIFICATION DES DONNÉES LIÉES ===");
        foreach ($tables as $table => $query) {
            try {
                $stmt = $this->db->prepare($query);
                $stmt->execute([$companyId]);
                $count = $stmt->fetchColumn();
                error_log("$table : $count enregistrements trouvés");
            } catch (Exception $e) {
                error_log("Erreur lors de la vérification de $table : " . $e->getMessage());
            }
        }
    }

    private function logTableCounts($companyId) {
        $tables = [
            'companies' => "SELECT COUNT(*) FROM companies WHERE id = ?",
            'internships' => "SELECT COUNT(*) FROM internships WHERE company_id = ?",
            'company_ratings' => "SELECT COUNT(*) FROM company_ratings WHERE company_id = ?",
            'internship_applications' => "SELECT COUNT(*) FROM internship_applications WHERE internship_id IN (SELECT id FROM internships WHERE company_id = ?)",
            'applications' => "SELECT COUNT(*) FROM applications WHERE internship_id IN (SELECT id FROM internships WHERE company_id = ?)",
            'internship_skills' => "SELECT COUNT(*) FROM internship_skills WHERE internship_id IN (SELECT id FROM internships WHERE company_id = ?)",
            'wishlists' => "SELECT COUNT(*) FROM wishlists WHERE internship_id IN (SELECT id FROM internships WHERE company_id = ?)"
        ];

        error_log("=== ÉTAT DES TABLES POUR L'ENTREPRISE ID $companyId ===");
        foreach ($tables as $table => $query) {
            try {
                $stmt = $this->db->prepare($query);
                $stmt->execute([$companyId]);
                $count = $stmt->fetchColumn();
                error_log("$table : $count enregistrements");
            } catch (Exception $e) {
                error_log("Erreur lors de la vérification de $table : " . $e->getMessage());
            }
        }
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
                (SELECT AVG(rating) FROM company_ratings WHERE company_id = c.id) as rating,
                (SELECT COUNT(*) FROM company_ratings WHERE company_id = c.id) as rating_count
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

    public function getAverageRating($companyId) {
        $sql = "SELECT AVG(rating) as avg_rating 
                FROM company_ratings 
                WHERE company_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$companyId]);
        $result = $stmt->fetch();
        return $result ? round($result['avg_rating'], 1) : 0;
    }

    public function getRatingCount($companyId) {
        $sql = "SELECT COUNT(*) as count 
                FROM company_ratings 
                WHERE company_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$companyId]);
        $result = $stmt->fetch();
        return $result ? $result['count'] : 0;
    }

    public function rate($companyId, $userId, $rating, $comment) {
        // Vérifier si l'utilisateur a déjà noté cette entreprise
        $sql = "SELECT id FROM company_ratings 
                WHERE company_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$companyId, $userId]);
        $existing = $stmt->fetch();

        if ($existing) {
            // Mettre à jour la note existante
            $sql = "UPDATE company_ratings 
                    SET rating = ?, comment = ?
                    WHERE company_id = ? AND user_id = ?";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$rating, $comment, $companyId, $userId]);
        } else {
            // Créer une nouvelle note
            $sql = "INSERT INTO company_ratings 
                    (company_id, user_id, rating, comment, created_at) 
                    VALUES (?, ?, ?, ?, NOW())";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$companyId, $userId, $rating, $comment]);
        }
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

    public function getUserRating($companyId, $userId) {
        $sql = "SELECT rating, comment 
                FROM company_ratings 
                WHERE company_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$companyId, $userId]);
        return $stmt->fetch();
    }
}