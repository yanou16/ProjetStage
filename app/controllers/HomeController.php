<?php

class HomeController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = [
            'title' => 'Accueil',
            'description' => 'Bienvenue sur notre plateforme de gestion des stages'
        ];
        
        $this->renderView('home/index', $data);
    }
}