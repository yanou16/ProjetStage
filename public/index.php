<?php
// Définir le chemin de base
define('BASE_PATH', dirname(__DIR__));

// Autoload des classes
spl_autoload_register(function ($class) {
    // Chemins possibles pour les classes
    $paths = [
        BASE_PATH . '/app/core/',
        BASE_PATH . '/app/controllers/',
        BASE_PATH . '/app/models/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Initialiser le routeur et traiter la requête
$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);
?>
