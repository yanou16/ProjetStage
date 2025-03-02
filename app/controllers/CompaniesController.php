<?php

class CompaniesController extends Controller {
    private $companyModel;

    public function __construct() {
        parent::__construct();
        $this->companyModel = $this->loadModel('Company');
        
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            $this->setFlashMessage('danger', 'Veuillez vous connecter');
            $this->redirect('/srx/users/login');
            return;
        }

        // Vérifier les permissions pour les actions de modification
        $userRole = $_SESSION['user']['role'] ?? null;
        $currentAction = $this->getCurrentAction();
        
        // Liste des actions réservées aux admin/pilote
        $restrictedActions = ['create', 'edit', 'delete', 'stats'];
        
        if (in_array($currentAction, $restrictedActions) && !in_array($userRole, ['admin', 'pilote'])) {
            $this->setFlashMessage('danger', 'Accès non autorisé');
            $this->redirect('/srx/companies');
            return;
        }
    }

    private function getCurrentAction() {
        $url = $_SERVER['REQUEST_URI'];
        $parts = explode('/', trim($url, '/'));
        return isset($parts[2]) ? $parts[2] : 'index';
    }

    public function index() {
        $data = [
            'title' => 'Gestion des entreprises',
            'companies' => $this->companyModel->getAll(),
            'user_role' => $_SESSION['user']['role']
        ];
        $this->renderView('companies/index', $data);
    }

    public function search() {
        $query = $_GET['q'] ?? '';
        $companies = $this->companyModel->search($query);
        echo json_encode($companies);
    }

    public function create() {
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
            'user_role' => $_SESSION['user']['role']
        ];
        $this->renderView('companies/create', $data);
    }

    public function edit($id) {
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
            'user_role' => $_SESSION['user']['role']
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
            'user_role' => $_SESSION['user']['role']
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
        if ($this->companyModel->delete($id)) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Entreprise supprimée avec succès'
            ];
        }
        header('Location: /srx/companies');
        exit;
    }

    public function stats() {
        // Récupérer le nombre total d'entreprises
        $totalCompanies = $this->companyModel->count();

        // Récupérer le nombre total de stages
        $totalInternships = $this->companyModel->countInternships();

        // Récupérer les statistiques par secteur
        $sectorStats = $this->companyModel->getSectorStats();

        // Récupérer le top des entreprises par nombre de stages
        $topCompanies = $this->companyModel->getTopCompaniesByInternships();

        $data = [
            'title' => 'Statistiques des entreprises',
            'totalCompanies' => $totalCompanies,
            'totalInternships' => $totalInternships,
            'sectorStats' => $sectorStats,
            'topCompanies' => $topCompanies,
            'user_role' => $_SESSION['user']['role']
        ];

        $this->renderView('companies/stats', $data);
    }
}