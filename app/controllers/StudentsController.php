<?php

class StudentsController extends Controller {
    private $studentModel;
    private $userRole;

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: /srx/auth/login');
            exit;
        }
        
        $this->studentModel = new Student();
        $this->userRole = $_SESSION['user']['role_name'];

        // Vérifier les permissions
        if ($this->userRole !== 'admin' && $this->userRole !== 'pilote') {
            header('Location: /srx/dashboard');
            exit;
        }
    }

    public function index() {
        $promotionId = $_GET['promotion_id'] ?? null;
        $data = [
            'title' => 'Gestion des étudiants',
            'students' => $this->studentModel->getAll($promotionId)
        ];
        $this->renderView('students/index', $data);
    }

    public function search() {
        $query = $_GET['q'] ?? '';
        $promotionId = $_GET['promotion_id'] ?? null;
        $students = $this->studentModel->search($query, $promotionId);
        echo json_encode($students);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->studentModel->create($_POST)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Étudiant créé avec succès'
                ];
                header('Location: /srx/students');
                exit;
            }
        }
        
        $data = [
            'title' => 'Créer un étudiant',
            'promotions' => $this->getPromotions()
        ];
        $this->renderView('students/create', $data);
    }

    public function edit($id) {
        $student = $this->studentModel->find($id);
        if (!$student) {
            header('Location: /srx/students');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->studentModel->update($id, $_POST)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Étudiant mis à jour avec succès'
                ];
                header('Location: /srx/students');
                exit;
            }
        }

        $data = [
            'title' => 'Modifier un étudiant',
            'student' => $student,
            'promotions' => $this->getPromotions()
        ];
        $this->renderView('students/edit', $data);
    }

    public function delete($id) {
        if ($this->userRole === 'admin') {
            if ($this->studentModel->delete($id)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Étudiant supprimé avec succès'
                ];
            }
        }
        header('Location: /srx/students');
        exit;
    }

    public function stats() {
        $data = [
            'title' => 'Statistiques des étudiants',
            'stats' => $this->studentModel->getStats()
        ];
        $this->renderView('students/stats', $data);
    }

    private function getPromotions() {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM promotions ORDER BY name")->fetchAll();
    }
}