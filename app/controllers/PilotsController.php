<?php

class PilotsController extends Controller {
    private $pilotModel;

    public function __construct() {
        // Vérifier si l'utilisateur est admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'admin') {
            header('Location: /srx/auth/login');
            exit;
        }
        $this->pilotModel = new Pilot();
    }

    public function index() {
        $data = [
            'title' => 'Gestion des pilotes',
            'pilots' => $this->pilotModel->getAll()
        ];
        $this->renderView('pilots/index', $data);
    }

    public function search() {
        $query = $_GET['q'] ?? '';
        $pilots = $this->pilotModel->search($query);
        echo json_encode($pilots);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->pilotModel->create($_POST)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Pilote créé avec succès'
                ];
                header('Location: /srx/pilots');
                exit;
            }
        }
        
        $data = ['title' => 'Créer un pilote'];
        $this->renderView('pilots/create', $data);
    }

    public function edit($id) {
        $pilot = $this->pilotModel->find($id);
        if (!$pilot) {
            header('Location: /srx/pilots');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->pilotModel->update($id, $_POST)) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Pilote mis à jour avec succès'
                ];
                header('Location: /srx/pilots');
                exit;
            }
        }

        $data = [
            'title' => 'Modifier un pilote',
            'pilot' => $pilot
        ];
        $this->renderView('pilots/edit', $data);
    }

    public function delete($id) {
        if ($this->pilotModel->delete($id)) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Pilote supprimé avec succès'
            ];
        }
        header('Location: /srx/pilots');
        exit;
    }
}