<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function login_page() {
        $this->render('login_page');
    }

    public function register_page() {
        $this->render('register_page');
    }


}