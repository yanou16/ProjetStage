<?php

class Router {
    private $routes = [];
    private $basePath = '/srx';

    public function __construct() {
        session_start();
    }

    public function dispatch($uri) {
        // Supprimer les paramètres de requête
        $uri = parse_url($uri, PHP_URL_PATH);
        
        // Supprimer le chemin de base et public s'il existe
        $uri = str_replace([$this->basePath, '/public'], '', $uri);
        
        // Si l'URI est vide, utiliser '/'
        if (empty($uri) || $uri === '/') {
            $controller = 'Home';
            $action = 'index';
            $params = [];
        } else {
            // Diviser l'URI en segments
            $segments = array_filter(explode('/', $uri));
            $segments = array_values($segments); // Réindexer le tableau
            
            // Déterminer le contrôleur, l'action et les paramètres
            $controller = isset($segments[0]) ? ucfirst($segments[0]) : 'Home';
            $action = isset($segments[1]) ? $segments[1] : 'index';
            $params = array_slice($segments, 2);
            
            // Ignorer le segment 'public' s'il existe
            if ($controller === 'Public') {
                array_shift($segments);
                $controller = isset($segments[0]) ? ucfirst($segments[0]) : 'Home';
                $action = isset($segments[1]) ? $segments[1] : 'index';
                $params = array_slice($segments, 2);
            }
        }

        // Ajouter 'Controller' au nom du contrôleur
        $controllerName = $controller . 'Controller';
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        try {
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                
                if (class_exists($controllerName)) {
                    $controllerInstance = new $controllerName();
                    
                    if (method_exists($controllerInstance, $action)) {
                        call_user_func_array([$controllerInstance, $action], $params);
                        return;
                    } else {
                        throw new Exception("Action '{$action}' not found in controller '{$controllerName}'");
                    }
                } else {
                    throw new Exception("Controller class '{$controllerName}' not found");
                }
            } else {
                throw new Exception("Controller file '{$controllerFile}' not found");
            }
        } catch (Exception $e) {
            // Log l'erreur
            error_log($e->getMessage());
            
            // Afficher une page d'erreur 404
            header("HTTP/1.0 404 Not Found");
            echo "<h1>404 Not Found</h1>";
            echo "<p>La page demandée n'existe pas.</p>";
            
            if ($_SERVER['SERVER_NAME'] === 'localhost') {
                echo "<p>Erreur: " . $e->getMessage() . "</p>";
                echo "<p>URI: " . $uri . "</p>";
                echo "<p>Controller: " . $controller . "</p>";
                echo "<p>Action: " . $action . "</p>";
            }
        }
    }
}