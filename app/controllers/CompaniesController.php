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

    /**
     * Helper function to remove a query parameter from the current URL
     */
    private function removeQueryParam($param) {
        $params = $_GET;
        unset($params[$param]);
        return '?' . http_build_query($params);
    }

    /**
     * Search companies with filters
     */
    public function search() {
        $query = $_GET['query'] ?? '';
        $industry = $_GET['industry'] ?? '';
        $location = $_GET['location'] ?? '';
        $sort = $_GET['sort'] ?? 'rating';

        $sql = "SELECT c.*, 
                COUNT(DISTINCT i.id) as internship_count,
                AVG(cr.rating) as avg_rating,
                COUNT(DISTINCT cr.id) as rating_count
                FROM companies c
                LEFT JOIN internships i ON c.id = i.company_id
                LEFT JOIN company_ratings cr ON c.id = cr.company_id
                WHERE 1=1";

        $params = [];

        if (!empty($query)) {
            $sql .= " AND (c.name LIKE ? OR c.description LIKE ?)";
            $params[] = "%$query%";
            $params[] = "%$query%";
        }

        if (!empty($industry)) {
            $sql .= " AND c.industry = ?";
            $params[] = $industry;
        }

        if (!empty($location)) {
            $sql .= " AND c.city = ?";
            $params[] = $location;
        }

        $sql .= " GROUP BY c.id";

        switch ($sort) {
            case 'rating':
                $sql .= " ORDER BY avg_rating DESC NULLS LAST";
                break;
            case 'internships':
                $sql .= " ORDER BY internship_count DESC";
                break;
            case 'recent':
                $sql .= " ORDER BY c.created_at DESC";
                break;
            default:
                $sql .= " ORDER BY c.name ASC";
        }

        $companies = $this->db->query($sql, $params)->fetchAll();

        // Ajouter la fonction helper à la vue
        $this->view->addHelper('removeQueryParam', [$this, 'removeQueryParam']);
        
        $this->view->render('companies/index', [
            'companies' => $companies,
            'title' => 'Recherche d\'entreprises',
            'filters' => [
                'query' => $query,
                'industry' => $industry,
                'location' => $location,
                'sort' => $sort
            ]
        ]);
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

        // Récupérer la moyenne des notes et le nombre d'avis
        $company['rating'] = $this->companyModel->getAverageRating($id);
        $company['rating_count'] = $this->companyModel->getRatingCount($id);
        
        // Récupérer la note de l'utilisateur actuel
        $userRating = $this->companyModel->getUserRating($id, $_SESSION['user']['id']);

        $data = [
            'title' => $company['name'],
            'company' => $company,
            'internships' => $internships,
            'user_role' => $_SESSION['user']['role'],
            'user_rating' => $userRating
        ];

        $this->renderView('companies/view', $data);
    }

    public function rate($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
            $comment = $_POST['comment'] ?? '';

            if ($rating < 1 || $rating > 5) {
                $this->setFlashMessage('danger', 'La note doit être comprise entre 1 et 5');
            } else {
                if ($this->companyModel->rate($id, $userId, $rating, $comment)) {
                    $this->setFlashMessage('success', 'Votre note a été enregistrée avec succès');
                } else {
                    $this->setFlashMessage('danger', 'Une erreur est survenue lors de l\'enregistrement de votre note');
                }
            }
        }
        $this->redirect("/srx/companies/view/$id");
    }

    public function delete($id) {
        header('Content-Type: application/json');

        try {
            // Vérifier si l'utilisateur est connecté
            if (!isset($_SESSION['user'])) {
                throw new Exception("Vous devez être connecté pour effectuer cette action.");
            }

            // Vérifier le rôle
            $userRole = $_SESSION['user']['role'];
            if (!in_array($userRole, ['admin', 'pilote'])) {
                throw new Exception("Vous n'avez pas les permissions nécessaires pour supprimer une entreprise.");
            }

            // Vérifier si l'entreprise existe
            $company = $this->companyModel->find($id);
            if (!$company) {
                throw new Exception("L'entreprise n'existe pas ou a déjà été supprimée.");
            }

            // Tenter de supprimer l'entreprise
            $this->companyModel->delete($id);

            echo json_encode([
                'success' => true,
                'message' => "L'entreprise et toutes ses données associées ont été supprimées avec succès."
            ]);

        } catch (Exception $e) {
            error_log("Erreur de suppression - Détails complets : " . $e->getMessage());
            
            // Préparer un message d'erreur détaillé pour l'interface utilisateur
            $errorMessage = "Erreur lors de la suppression de l'entreprise.\n";
            $errorDetails = explode("\n", $e->getMessage());
            
            error_log("Erreur lors de la suppression de l'entreprise $id: " . $e->getMessage());
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        exit();
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

        $stats = [
            'total_internships' => 0,
            'active_internships' => 0,
            'internship_trend' => 0,
            'total_applications' => 0,
            'monthly_applications' => [],
            'average_rating' => 0,
            'rating_distribution' => []
        ];

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