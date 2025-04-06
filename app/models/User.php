<?php

class User extends Model {
    private $id;
    private $username;
    private $email;
    private $password;
    private $role_id;

    public function findUserByEmail($email) {
        $sql = "SELECT u.*, r.name as role_name 
                FROM users u 
                JOIN roles r ON u.role_id = r.id 
                WHERE u.email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $sql = "SELECT u.*, r.name as role_name 
                FROM users u 
                JOIN roles r ON u.role_id = r.id 
                WHERE u.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        // Le mot de passe est déjà hashé dans le contrôleur
        
        $sql = "INSERT INTO users (username, email, password, role_id, created_at) 
                VALUES (?, ?, ?, ?, NOW())";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['username'],
            $data['email'],
            $data['password'],
            $data['role_id']
        ]);
    }

    public function getAllUsers() {
        $sql = "SELECT u.*, r.name as role_name 
                FROM users u 
                JOIN roles r ON u.role_id = r.id 
                ORDER BY u.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update($id, $data) {
        // Construire la requête en fonction des données fournies
        $fields = [];
        $values = [];
        
        if (isset($data['username'])) {
            $fields[] = "username = ?";
            $values[] = $data['username'];
        }
        
        if (isset($data['email'])) {
            $fields[] = "email = ?";
            $values[] = $data['email'];
        }
        
        if (isset($data['password'])) {
            $fields[] = "password = ?";
            $values[] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        if (isset($data['role_id'])) {
            $fields[] = "role_id = ?";
            $values[] = $data['role_id'];
        }
        
        if (empty($fields)) {
            return false;
        }
        
        $sql = "UPDATE users SET " . implode(", ", $fields) . ", updated_at = NOW() WHERE id = ?";
        $values[] = $id;
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    public function delete($id) {
        try {
            $this->db->beginTransaction();

            // 1. Supprimer les évaluations d'entreprises de l'utilisateur
            $sql = "DELETE FROM company_ratings WHERE user_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            // 2. Supprimer les candidatures de l'utilisateur
            $sql = "DELETE FROM applications WHERE user_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            // 3. Supprimer les wishlists de l'utilisateur
            $sql = "DELETE FROM wishlists WHERE user_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            // 4. Supprimer les candidatures aux stages
            $sql = "DELETE FROM internship_applications WHERE student_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            // 5. Enfin, supprimer l'utilisateur
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Erreur lors de la suppression de l'utilisateur: " . $e->getMessage());
            return false;
        }
    }

    // Méthodes pour gérer les transactions
    public function beginTransaction() {
        return $this->db->beginTransaction();
    }

    public function commit() {
        return $this->db->commit();
    }

    public function rollback() {
        return $this->db->rollBack();
    }

    // Méthode pour supprimer les candidatures d'un utilisateur
    public function deleteUserApplications($userId) {
        $sql = "DELETE FROM internship_applications WHERE student_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId]);
    }
}