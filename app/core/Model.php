<?php

class Model {
    protected $db;

    public function __construct() {
        try {
            $this->db = Database::getInstance();
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}