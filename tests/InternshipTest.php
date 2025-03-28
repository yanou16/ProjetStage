<?php

require_once __DIR__ . '/../app/core/Database.php';

use PHPUnit\Framework\TestCase;

/**
 * @testdox Tests de gestion des stages
 */
class InternshipTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        $this->db = Database::getInstance();
    }

    /**
     * @testdox Peut créer un nouveau stage avec une entreprise
     */
    public function testCreateInternship()
    {
        // Créer d'abord une entreprise de test si nécessaire
        $stmtCompany = $this->db->prepare("
            INSERT INTO companies (name, description, contact_email) 
            VALUES (:name, :description, :email)
        ");
        
        $companyData = [
            'name' => 'Entreprise Test',
            'description' => 'Description de l\'entreprise test',
            'email' => 'test@test.com'
        ];
        
        $stmtCompany->execute($companyData);
        $companyId = $this->db->lastInsertId();

        // Préparer les données du stage
        $data = [
            'title' => 'Stage Test PHPUnit',
            'company_id' => $companyId,
            'description' => 'Description du stage de test',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d', strtotime('+6 months')),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insérer le stage
        $stmt = $this->db->prepare("
            INSERT INTO internships (title, company_id, description, start_date, end_date, created_at) 
            VALUES (:title, :company_id, :description, :start_date, :end_date, :created_at)
        ");
        
        $result = $stmt->execute($data);
        
        // Vérifier que l'insertion a réussi
        $this->assertTrue($result, "L'insertion du stage a réussi");
        
        // Récupérer le dernier ID inséré
        $id = $this->db->lastInsertId();
        
        // Vérifier que le stage existe dans la base
        $stmt = $this->db->prepare("SELECT * FROM internships WHERE id = ?");
        $stmt->execute([$id]);
        $internship = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérifier les données
        $this->assertEquals($data['title'], $internship['title'], "Le titre du stage est correct");
        $this->assertEquals($data['description'], $internship['description'], "La description du stage est correcte");
        
        // Nettoyer - Supprimer le stage et l'entreprise de test
        $stmt = $this->db->prepare("DELETE FROM internships WHERE id = ?");
        $stmt->execute([$id]);
        
        $stmt = $this->db->prepare("DELETE FROM companies WHERE id = ?");
        $stmt->execute([$companyId]);
    }
}