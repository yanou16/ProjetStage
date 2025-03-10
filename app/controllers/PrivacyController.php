<?php

class PrivacyController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = [
            'title' => 'Politique de confidentialité',
            'description' => 'Notre politique de confidentialité'
        ];
        
        $this->renderView('privacy/index', $data);
    }
}