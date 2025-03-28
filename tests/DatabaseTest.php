<?php

require_once __DIR__ . '/../app/core/Database.php';

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        $this->db = Database::getInstance();
    }

    public function testDatabaseConnection()
    {
        // Test si l'instance de la base de données est créée correctement
        $this->assertInstanceOf(PDO::class, $this->db);
    }

    public function testQueryExecution()
    {
        // Test d'une requête simple
        $stmt = $this->db->query("SELECT 1 as test");
        
        // Vérifie si la requête s'exécute sans erreur
        $this->assertNotFalse($stmt);
        
        // Vérifie si le résultat est celui attendu
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEquals(1, $row['test']);
    }
}