<?php

class Internship extends Model {
    public function __construct() {
        parent::__construct();
        
        // Ajouter les colonnes manquantes si elles n'existent pas
        $this->addMissingColumns();
    }

    private function addMissingColumns() {
        $sql = "
            ALTER TABLE internships 
            ADD COLUMN IF NOT EXISTS title VARCHAR(255) NOT NULL,
            ADD COLUMN IF NOT EXISTS description TEXT NULL,
            ADD COLUMN IF NOT EXISTS company_id INT NOT NULL,
            ADD COLUMN IF NOT EXISTS start_date DATE NOT NULL,
            ADD COLUMN IF NOT EXISTS duration INT NOT NULL COMMENT 'Duration in weeks',
            ADD COLUMN IF NOT EXISTS skills_required TEXT NULL,
            ADD COLUMN IF NOT EXISTS compensation DECIMAL(10,2) NULL,
            ADD COLUMN IF NOT EXISTS status ENUM('draft', 'published', 'closed') DEFAULT 'draft',
            ADD COLUMN IF NOT EXISTS created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
            ADD FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE
        ";
        $this->db->exec($sql);

        // Créer la table des candidatures
        $sql = "CREATE TABLE IF NOT EXISTS internship_applications (
            id INT PRIMARY KEY AUTO_INCREMENT,
            internship_id INT NOT NULL,
            student_id INT NOT NULL,
            motivation_letter TEXT,
            cv_path VARCHAR(255),
            status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (internship_id) REFERENCES internships(id) ON DELETE CASCADE,
            FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
            UNIQUE KEY unique_application (internship_id, student_id)
        )";
        $this->db->exec($sql);

        // Créer la table de la wishlist
        $sql = "CREATE TABLE IF NOT EXISTS wishlist (
            id INT PRIMARY KEY AUTO_INCREMENT,
            internship_id INT NOT NULL,
            user_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (internship_id) REFERENCES internships(id) ON DELETE CASCADE,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            UNIQUE KEY unique_wishlist (internship_id, user_id)
        )";
        $this->db->exec($sql);
    }

    public function create($data) {
        $sql = "INSERT INTO internships (
            title, description, company_id, start_date, duration, 
            skills_required, compensation, status, created_at
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, 'published', NOW()
        )";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['company_id'],
            $data['start_date'],
            $data['duration'],
            $data['skills_required'],
            $data['compensation'] ?? null
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE internships 
                SET title = ?, description = ?, company_id = ?, 
                    start_date = ?, duration = ?, skills_required = ?, 
                    compensation = ?, updated_at = NOW()
                WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['company_id'],
            $data['start_date'],
            $data['duration'],
            $data['skills_required'],
            $data['compensation'],
            $id
        ]);
    }

    public function delete($id) {
        try {
            $this->db->beginTransaction();

            // Supprimer d'abord les candidatures associées
            $sql = "DELETE FROM internship_applications WHERE internship_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            // Supprimer le stage
            $sql = "DELETE FROM internships WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([$id]);

            $this->db->commit();
            return $result;
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Erreur lors de la suppression du stage: " . $e->getMessage());
            return false;
        }
    }

    public function find($id) {
        $sql = "SELECT i.*, c.name as company_name 
                FROM internships i 
                LEFT JOIN companies c ON i.company_id = c.id 
                WHERE i.id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $sql = "SELECT i.*, c.name as company_name, c.city as company_city 
                FROM internships i 
                JOIN companies c ON i.company_id = c.id 
                WHERE i.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function search($query = '', $filters = []) {
        $sql = "SELECT i.*, c.name as company_name 
                FROM internships i 
                LEFT JOIN companies c ON i.company_id = c.id 
                WHERE 1=1";
        $params = [];

        if (!empty($query)) {
            $sql .= " AND (i.title LIKE ? OR i.description LIKE ?)";
            $params[] = "%{$query}%";
            $params[] = "%{$query}%";
        }

        if (!empty($filters['company_id'])) {
            $sql .= " AND i.company_id = ?";
            $params[] = $filters['company_id'];
        }

        if (!empty($filters['skills'])) {
            $sql .= " AND i.skills_required LIKE ?";
            $params[] = "%{$filters['skills']}%";
        }

        $sql .= " ORDER BY i.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getStats() {
        $stats = [];
        
        // Nombre total d'offres
        $sql = "SELECT COUNT(*) as count FROM internships";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['total'] = $stmt->fetch()['count'];
        
        // Nombre d'offres par entreprise
        $sql = "SELECT c.name, COUNT(*) as count 
                FROM internships i 
                JOIN companies c ON i.company_id = c.id 
                GROUP BY c.id 
                ORDER BY count DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats['by_company'] = $stmt->fetchAll();
        
        return $stats;
    }

    public function getGlobalStats() {
        $stats = [];

        // Nombre total de stages
        $sql = "SELECT COUNT(*) as total FROM internships";
        $stmt = $this->db->query($sql);
        $stats['total_internships'] = $stmt->fetch()['total'];

        // Nombre total de candidatures
        $sql = "SELECT COUNT(*) as total FROM internship_applications";
        $stmt = $this->db->query($sql);
        $stats['total_applications'] = $stmt->fetch()['total'];

        // Répartition des statuts
        $sql = "SELECT status, COUNT(*) as count 
                FROM internship_applications 
                GROUP BY status";
        $stmt = $this->db->query($sql);
        $stats['status_distribution'] = $stmt->fetchAll();

        // Top 5 des stages les plus demandés
        $sql = "SELECT i.title, i.id, COUNT(a.id) as applications_count 
                FROM internships i 
                LEFT JOIN internship_applications a ON i.id = a.internship_id 
                GROUP BY i.id 
                ORDER BY applications_count DESC 
                LIMIT 5";
        $stmt = $this->db->query($sql);
        $stats['top_internships'] = $stmt->fetchAll();

        return $stats;
    }

    public function getCompanyStats($companyId) {
        $stats = [];

        // Nombre de stages de l'entreprise
        $sql = "SELECT COUNT(*) as total FROM internships WHERE company_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$companyId]);
        $stats['total_internships'] = $stmt->fetch()['total'];

        // Nombre total de candidatures pour les stages de l'entreprise
        $sql = "SELECT COUNT(*) as total 
                FROM internship_applications a 
                JOIN internships i ON a.internship_id = i.id 
                WHERE i.company_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$companyId]);
        $stats['total_applications'] = $stmt->fetch()['total'];

        // Répartition des statuts pour l'entreprise
        $sql = "SELECT a.status, COUNT(*) as count 
                FROM internship_applications a 
                JOIN internships i ON a.internship_id = i.id 
                WHERE i.company_id = ? 
                GROUP BY a.status";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$companyId]);
        $stats['status_distribution'] = $stmt->fetchAll();

        // Détails des stages de l'entreprise avec leurs candidatures
        $sql = "SELECT i.title, i.id, COUNT(a.id) as applications_count 
                FROM internships i 
                LEFT JOIN internship_applications a ON i.id = a.internship_id 
                WHERE i.company_id = ? 
                GROUP BY i.id 
                ORDER BY applications_count DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$companyId]);
        $stats['internships_details'] = $stmt->fetchAll();

        return $stats;
    }

    public function applyForInternship($internshipId, $userId, $message, $cvPath) {
        try {
            // Vérifier la connexion à la base de données
            if (!$this->db) {
                error_log("Erreur: Pas de connexion à la base de données");
                return false;
            }

            // Vérifier si le stage existe
            $internshipCheck = $this->findById($internshipId);
            if (!$internshipCheck) {
                error_log("Stage non trouvé: " . $internshipId);
                return false;
            }

            // Vérifier si l'utilisateur existe
            $userCheck = $this->db->prepare("SELECT id FROM users WHERE id = ?");
            $userCheck->execute([$userId]);
            if (!$userCheck->fetch()) {
                error_log("Utilisateur non trouvé: " . $userId);
                return false;
            }

            // Vérifier si l'étudiant a déjà postulé
            $checkExisting = $this->db->prepare("SELECT id FROM internship_applications WHERE internship_id = ? AND student_id = ?");
            $checkExisting->execute([$internshipId, $userId]);
            if ($checkExisting->fetch()) {
                error_log("L'étudiant a déjà postulé à ce stage");
                return 'already_applied';
            }

            // Insérer la candidature
            $sql = "INSERT INTO internship_applications (internship_id, student_id, motivation_letter, cv_path, status, created_at) 
                    VALUES (?, ?, ?, ?, 'pending', NOW())";
            error_log("SQL à exécuter: " . $sql);
            error_log("Paramètres: internship_id=" . $internshipId . ", student_id=" . $userId . 
                     ", message=" . substr($message, 0, 50) . "..., cv_path=" . $cvPath);
            
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([$internshipId, $userId, $message, $cvPath]);

            if (!$result) {
                $error = $stmt->errorInfo();
                error_log("Erreur SQL: " . print_r($error, true));
                return false;
            }

            error_log("Candidature créée avec succès");
            return true;

        } catch (PDOException $e) {
            error_log("Exception PDO: " . $e->getMessage());
            error_log("Code d'erreur: " . $e->getCode());
            error_log("Trace: " . $e->getTraceAsString());
            if ($e->getCode() == '23000') {
                return 'already_applied';
            }
            return false;
        } catch (Exception $e) {
            error_log("Exception générale: " . $e->getMessage());
            error_log("Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function addToWishlist($internshipId, $userId) {
        try {
            $sql = "INSERT INTO wishlist (internship_id, user_id) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$internshipId, $userId]);
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') { // Violation de contrainte unique
                return 'already_in_wishlist';
            }
            return false;
        }
    }

    public function removeFromWishlist($internshipId, $userId) {
        $sql = "DELETE FROM wishlist WHERE internship_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$internshipId, $userId]);
    }

    public function hasApplied($internshipId, $userId) {
        $sql = "SELECT COUNT(*) as count FROM internship_applications WHERE internship_id = ? AND student_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$internshipId, $userId]);
        return $stmt->fetch()['count'] > 0;
    }

    public function isInWishlist($internshipId, $userId) {
        $sql = "SELECT COUNT(*) as count FROM wishlist WHERE internship_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$internshipId, $userId]);
        return $stmt->fetch()['count'] > 0;
    }

    public function getStudentApplications($studentId) {
        $sql = "SELECT a.*, i.title as internship_title, i.description, 
                       c.name as company_name, c.id as company_id
                FROM internship_applications a
                JOIN internships i ON a.internship_id = i.id
                JOIN companies c ON i.company_id = c.id
                WHERE a.student_id = ?
                ORDER BY a.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll();
    }

    public function getStudentWishlist($studentId) {
        $sql = "SELECT 
                    i.*,
                    c.name as company_name,
                    c.id as company_id,
                    w.created_at as added_date,
                    i.id as internship_id,
                    i.title as internship_title
                FROM wishlist w
                JOIN internships i ON w.internship_id = i.id
                JOIN companies c ON i.company_id = c.id
                WHERE w.user_id = ?
                ORDER BY w.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll();
    }

    public function getStudentStats() {
        $stats = [];

        // Nombre total d'étudiants ayant postulé
        $sql = "SELECT COUNT(DISTINCT student_id) as total 
                FROM internship_applications";
        $stmt = $this->db->query($sql);
        $stats['total_active_students'] = $stmt->fetch()['total'];

        // Nombre moyen de candidatures par étudiant
        $sql = "SELECT AVG(application_count) as avg_applications
                FROM (
                    SELECT student_id, COUNT(*) as application_count
                    FROM internship_applications
                    GROUP BY student_id
                ) as student_counts";
        $stmt = $this->db->query($sql);
        $stats['avg_applications_per_student'] = round($stmt->fetch()['avg_applications'], 2);

        // Distribution des statuts des candidatures
        $sql = "SELECT status, COUNT(*) as count
                FROM internship_applications
                GROUP BY status";
        $stmt = $this->db->query($sql);
        $stats['application_status_distribution'] = $stmt->fetchAll();

        // Top 5 des étudiants les plus actifs
        $sql = "SELECT u.id, u.name, COUNT(a.id) as application_count
                FROM users u
                JOIN internship_applications a ON u.id = a.student_id
                GROUP BY u.id
                ORDER BY application_count DESC
                LIMIT 5";
        $stmt = $this->db->query($sql);
        $stats['top_active_students'] = $stmt->fetchAll();

        // Statistiques par mois
        $sql = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month,
                       COUNT(*) as total_applications
                FROM internship_applications
                GROUP BY month
                ORDER BY month DESC
                LIMIT 6";
        $stmt = $this->db->query($sql);
        $stats['monthly_applications'] = $stmt->fetchAll();

        return $stats;
    }
}