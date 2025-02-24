<?php

class CompaniesController extends Controller {
    private $companyModel;
    private $userRole;

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: /srx/auth/login');
            exit;
        }
        
        $this->companyModel = new Company();
        $this->userRole = $_SESSION['user']['role'];
    }

    public function index() {
        $data = [
            'title' => 'Gestion des entreprises',
            'companies' => $this->companyModel->getAll(),
            'user_role' => $this->userRole
        ];
        $this->renderView('companies/index', $data);
    }

    public function search() {
        $query = $_GET['q'] ?? '';
        $companies = $this->companyModel->search($query);
        echo json_encode($companies);
    }

    public function create() {
        if ($this->userRole !== 'admin' && $this->userRole !== 'pilote') {
            header('Location: /srx/companies');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->companyModel->create($_POST)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Entreprise créée avec succès'
                ];
                header('Location: /srx/companies');
                exit;
            }
        }
        
        $data = [
            'title' => 'Créer une entreprise',
            'user_role' => $this->userRole
        ];
        $this->renderView('companies/create', $data);
    }

    public function edit($id) {
        if ($this->userRole !== 'admin' && $this->userRole !== 'pilote') {
            header('Location: /srx/companies');
            exit;
        }

        $company = $this->companyModel->find($id);
        if (!$company) {
            header('Location: /srx/companies');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->companyModel->update($id, $_POST)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Entreprise mise à jour avec succès'
                ];
                header('Location: /srx/companies');
                exit;
            }
        }

        $data = [
            'title' => 'Modifier une entreprise',
            'company' => $company,
            'user_role' => $this->userRole
        ];
        $this->renderView('companies/edit', $data);
    }

    public function view($id = null) {
        if (!$id) {
            $this->setFlashMessage('danger', 'ID entreprise non spécifié');
            $this->redirect('/srx/companies');
        }

        // Charger l'entreprise et ses stages
        $company = $this->companyModel->find($id);
        $internships = $this->companyModel->getInternshipsByCompany($id);

        if (!$company) {
            $this->setFlashMessage('danger', 'Entreprise non trouvée');
            $this->redirect('/srx/companies');
        }

        $data = [
            'title' => $company['name'],
            'company' => $company,
            'internships' => $internships,
            'user_role' => $this->userRole
        ];

        $this->renderView('companies/view', $data);
    }

    public function rate($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];

            if ($this->companyModel->rate($id, $userId, $rating, $comment)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Évaluation ajoutée avec succès'
                ];
            }
        }
        header("Location: /srx/companies/view/$id");
        exit;
    }

    public function delete($id) {
        if ($this->userRole === 'admin') {
            if ($this->companyModel->delete($id)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Entreprise supprimée avec succès'
                ];
            }
        }
        header('Location: /srx/companies');
        exit;
    }

    public function stats() {
        if ($this->userRole !== 'admin' && $this->userRole !== 'pilote') {
            header('Location: /srx/companies');
            exit;
        }

        $data = [
            'title' => 'Statistiques des entreprises',
            'stats' => $this->companyModel->getStats(),
            'user_role' => $this->userRole
        ];
        $this->renderView('companies/stats', $data);
    }
}