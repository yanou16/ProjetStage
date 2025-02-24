<?php

class Controller {
    protected $db;

    public function __construct() {
        // Initialisation de la connexion à la base de données
        $this->db = Database::getInstance();
    }

    public function loadModel($model) {
        $modelFile = __DIR__ . '/../models/' . $model . '.php';
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            throw new Exception("Le modèle $model n'existe pas.");
        }
    }

    public function renderView($view, $data = []) {
        // Extraction des données pour les rendre disponibles dans la vue
        if (!empty($data)) {
            extract($data);
        }

        // Démarrer la mise en mémoire tampon
        ob_start();
        
        // Inclure la vue
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            throw new Exception("La vue $view n'existe pas.");
        }
        
        // Récupérer le contenu de la vue
        $content = ob_get_clean();
        
        // Inclure le layout principal
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    public function setFlashMessage($type, $message) {
        $_SESSION['flash_message'] = [
            'type' => $type,
            'message' => $message
        ];
    }
}

?>