<?php
    require_once 'base/View.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/GlobalDefs.php';

    class LoginView extends View {
        public function __construct() {
            $this->pageTitle = 'Login';
            $this->title = '';
        }

        protected function drawPage() {
            self::login($this->response->getValue('username'),
                        $this->response->getValue('password'),
                        $this->response->getValue('error'));
        } 

        private function login($username, $password, $error = '') {
            require_once 'util/login/login.php';
        }
    }
?>