<?php
    require_once 'base/View.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/GlobalDefs.php';

    class ProfileView extends View {
        private $page;

        public function __construct() {
            $this->pageTitle = 'Perfil';
            $this->page = ''; 
        }

        public function setup(Response $response) {
            parent::setup($response); 
            $this->page = $response->getPageInfoView();
        }

        protected function drawPage() {
            /*echo '<p>Perfil<p>';
            echo '<pre>';
            print_r(getUser());
            echo '</pre><br>';
            echo '<pre>';
            print_r($this->response);
            echo '</pre>';*/
            self::profileWorker($this->response, getUser());
        }

        private function profileWorker($response, $user) {
            require_once 'util/profile/profile.php';
        }
    }
?>