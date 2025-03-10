<?php

class TermsController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = [
            'title' => 'Conditions d\'utilisation',
            'description' => 'Nos conditions générales d\'utilisation'
        ];
        
        $this->renderView('terms/index', $data);
    }
}