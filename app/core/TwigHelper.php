<?php
require_once __DIR__ . '/../../vendor/autoload.php';

class TwigHelper {
    private static $instance = null;
    private $twig;
    
    private function __construct() {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function render($template, $data = []) {
        return $this->twig->render($template, $data);
    }
}