<?php

class UploadsController extends Controller {
    
    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: /srx/auth/login');
            exit;
        }
    }

    public function cv($filename = null) {
        if (!$filename) {
            header('HTTP/1.0 404 Not Found');
            exit('File not found');
        }

        $filepath = dirname(dirname(__DIR__)) . '/public/uploads/cv/' . $filename;
        
        // Vérifier si le fichier existe
        if (!file_exists($filepath)) {
            header('HTTP/1.0 404 Not Found');
            exit('File not found');
        }

        // Vérifier l'extension du fichier
        if (pathinfo($filepath, PATHINFO_EXTENSION) !== 'pdf') {
            header('HTTP/1.0 403 Forbidden');
            exit('Invalid file type');
        }

        // Envoyer le fichier PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($filepath) . '"');
        header('Content-Length: ' . filesize($filepath));
        header('Cache-Control: public, max-age=86400');
        
        readfile($filepath);
        exit;
    }
}