<?php

class InternshipsController extends Controller {
    private $internshipModel;
    private $userRole;
    private $companyModel;

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: /srx/auth/login');
            exit;
        }
        
        $this->internshipModel = new Internship();
        $this->userRole = $_SESSION['user']['role'];
        $this->companyModel = new Company();
    }

    public function index() {
        $query = $_GET['q'] ?? '';
        $filters = [
            'company_id' => $_GET['company_id'] ?? null,
            'skills' => $_GET['skills'] ?? null
        ];

        $data = [
            'title' => 'Offres de stage',
            'internships' => $this->internshipModel->search($query, $filters),
            'companies' => $this->getCompanies()
        ];
        $this->renderView('internships/index', $data);
    }

    public function create() {
        if ($this->userRole === 'student') {
            header('Location: /srx/internships');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->internshipModel->create($_POST)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Offre de stage créée avec succès'
                ];
                header('Location: /srx/internships');
                exit;
            }
        }

        $data = [
            'title' => 'Créer une offre de stage',
            'companies' => $this->getCompanies()
        ];
        $this->renderView('internships/create', $data);
    }

    public function edit($id) {
        if ($this->userRole === 'student') {
            header('Location: /srx/internships');
            exit;
        }

        $internship = $this->internshipModel->find($id);
        if (!$internship) {
            header('Location: /srx/internships');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->internshipModel->update($id, $_POST)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Offre de stage mise à jour avec succès'
                ];
                header('Location: /srx/internships');
                exit;
            }
        }

        $data = [
            'title' => 'Modifier une offre de stage',
            'internship' => $internship,
            'companies' => $this->getCompanies()
        ];
        $this->renderView('internships/edit', $data);
    }

    public function delete($id) {
        if ($this->userRole === 'student') {
            header('Location: /srx/internships');
            exit;
        }

        if ($this->internshipModel->delete($id)) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Offre de stage supprimée avec succès'
            ];
        }
        header('Location: /srx/internships');
        exit;
    }

    public function stats() {
        // Vérifier si l'utilisateur est connecté et a les droits
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin', 'company', 'pilote'])) {
            $this->setFlashMessage('danger', 'Accès non autorisé');
            $this->redirect('/srx/internships');
        }

        $stats = [];
        
        if (in_array($_SESSION['user']['role'], ['admin', 'pilote'])) {
            // Statistiques globales pour l'admin et le pilote
            $stats = $this->internshipModel->getGlobalStats();
        } else {
            // Statistiques pour l'entreprise
            $companyId = $_SESSION['user']['company_id'];
            $stats = $this->internshipModel->getCompanyStats($companyId);
        }

        $data = [
            'title' => 'Statistiques des candidatures',
            'stats' => $stats
        ];

        $this->renderView('internships/stats', $data);
    }

    public function view($id = null) {
        if (!$id) {
            $this->setFlashMessage('danger', 'ID stage non spécifié');
            $this->redirect('/srx/internships');
        }

        // Charger le stage et les informations de l'entreprise
        $internship = $this->internshipModel->findById($id);
        
        if (!$internship) {
            $this->setFlashMessage('danger', 'Stage non trouvé');
            $this->redirect('/srx/internships');
        }

        // Charger les informations de l'entreprise
        $company = $this->companyModel->findById($internship['company_id']);

        // Vérifier si l'étudiant a déjà postulé ou ajouté à sa wishlist
        $hasApplied = false;
        $isInWishlist = false;
        if ($this->userRole === 'student') {
            $hasApplied = $this->internshipModel->hasApplied($id, $_SESSION['user']['id']);
            $isInWishlist = $this->internshipModel->isInWishlist($id, $_SESSION['user']['id']);
        }

        $data = [
            'title' => $internship['title'],
            'internship' => $internship,
            'company' => $company,
            'hasApplied' => $hasApplied,
            'isInWishlist' => $isInWishlist
        ];

        $this->renderView('internships/view', $data);
    }

    public function apply($id = null) {
        if ($this->userRole !== 'student' && $this->userRole !== 'admin') {
            $this->setFlashMessage('danger', 'Seuls les étudiants et les administrateurs peuvent postuler aux stages');
            $this->redirect('/srx/internships');
        }

        if (!$id || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/srx/internships');
        }

        // Vérifier si le stage existe
        $internship = $this->internshipModel->findById($id);
        if (!$internship) {
            $this->setFlashMessage('danger', 'Stage non trouvé');
            $this->redirect('/srx/internships');
            return;
        }

        // Vérifier le message de motivation
        $message = trim($_POST['message'] ?? '');
        if (empty($message)) {
            $this->setFlashMessage('danger', 'Le message de motivation est requis');
            $this->redirect("/srx/internships/view/{$id}");
            return;
        }

        // Gérer l'upload du CV
        $cvPath = '';
        if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['cv'];
            
            // Vérifier le type de fichier
            $allowedTypes = ['application/pdf'];
            if (!in_array($file['type'], $allowedTypes)) {
                $this->setFlashMessage('danger', 'Seuls les fichiers PDF sont acceptés');
                $this->redirect("/srx/internships/view/{$id}");
                return;
            }

            // Vérifier la taille du fichier (5MB max)
            if ($file['size'] > 5 * 1024 * 1024) {
                $this->setFlashMessage('danger', 'Le fichier ne doit pas dépasser 5MB');
                $this->redirect("/srx/internships/view/{$id}");
                return;
            }

            // Créer le dossier des CV s'il n'existe pas
            $uploadDir = dirname(dirname(__DIR__)) . '/public/uploads/cv/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Générer un nom de fichier unique
            $fileName = uniqid('cv_') . '_' . $_SESSION['user']['id'] . '.pdf';
            $cvPath = 'uploads/cv/' . $fileName;

            // Déplacer le fichier
            if (!move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
                $this->setFlashMessage('danger', 'Erreur lors de l\'upload du CV');
                $this->redirect("/srx/internships/view/{$id}");
                return;
            }
        } else {
            $this->setFlashMessage('danger', 'Le CV est requis');
            $this->redirect("/srx/internships/view/{$id}");
            return;
        }

        // Envoyer la candidature
        $result = $this->internshipModel->applyForInternship($id, $_SESSION['user']['id'], $message, $cvPath);

        if ($result === true) {
            $this->setFlashMessage('success', 'Votre candidature a été envoyée avec succès');
        } elseif ($result === 'already_applied') {
            $this->setFlashMessage('warning', 'Vous avez déjà postulé à ce stage');
        } else {
            $this->setFlashMessage('danger', 'Une erreur est survenue lors de l\'envoi de votre candidature');
            // Supprimer le CV si la candidature a échoué
            if (file_exists($uploadDir . $fileName)) {
                unlink($uploadDir . $fileName);
            }
        }

        $this->redirect("/srx/internships/view/{$id}");
    }

    public function toggleWishlist($id = null) {
        if ($this->userRole !== 'student') {
            $this->setFlashMessage('danger', 'Seuls les étudiants peuvent ajouter des stages à leur wishlist');
            $this->redirect('/srx/internships');
        }

        if (!$id) {
            $this->redirect('/srx/internships');
        }

        $isInWishlist = $this->internshipModel->isInWishlist($id, $_SESSION['user']['id']);
        
        if ($isInWishlist) {
            if ($this->internshipModel->removeFromWishlist($id, $_SESSION['user']['id'])) {
                $this->setFlashMessage('success', 'Stage retiré de votre wishlist');
            }
        } else {
            $result = $this->internshipModel->addToWishlist($id, $_SESSION['user']['id']);
            if ($result === true) {
                $this->setFlashMessage('success', 'Stage ajouté à votre wishlist');
            } elseif ($result === 'already_in_wishlist') {
                $this->setFlashMessage('warning', 'Ce stage est déjà dans votre wishlist');
            }
        }

        $this->redirect("/srx/internships/view/{$id}");
    }

    public function myApplications() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
            $this->setFlashMessage('danger', 'Accès non autorisé');
            $this->redirect('/srx/internships');
            return;
        }

        $applications = $this->internshipModel->getStudentApplications($_SESSION['user']['id']);
        
        $data = [
            'title' => 'Mes candidatures',
            'applications' => $applications
        ];

        $this->renderView('internships/my_applications', $data);
    }

    public function myWishlist() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
            $this->setFlashMessage('danger', 'Accès non autorisé');
            $this->redirect('/srx/internships');
            return;
        }

        $wishlist = $this->internshipModel->getStudentWishlist($_SESSION['user']['id']);
        
        $data = [
            'title' => 'Ma liste de souhaits',
            'wishlist' => $wishlist
        ];

        $this->renderView('internships/my_wishlist', $data);
    }

    public function studentStats() {
        if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin', 'pilote'])) {
            $this->setFlashMessage('danger', 'Accès non autorisé');
            $this->redirect('/srx/internships');
            return;
        }

        $stats = $this->internshipModel->getStudentStats();
        
        $data = [
            'title' => 'Statistiques des étudiants',
            'stats' => $stats
        ];

        $this->renderView('internships/student_stats', $data);
    }

    private function getCompanies() {
        $db = Database::getInstance();
        return $db->query("SELECT id, name FROM companies ORDER BY name")->fetchAll();
    }
}