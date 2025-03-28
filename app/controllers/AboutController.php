<?php
class AboutController extends Controller {
    public function index() {
        $data = [
            'title' => 'À propos de SRX',
            'description' => 'Plateforme de gestion de stages',
            'features' => [
                'Recherche de stages',
                'Gestion des candidatures',
                'Suivi des étudiants'
            ]
        ];
        
        $twig = TwigHelper::getInstance();
        echo $twig->render('about.twig', $data);
    }
}