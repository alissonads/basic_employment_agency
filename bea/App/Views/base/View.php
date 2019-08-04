<?php
    require_once 'ViewInterface.php';
    require_once 'App/utils/Response.php';

    abstract class View implements ViewInterface {
        protected $response;
        protected $pageTitle;
        protected $title;

        public function setup(Response $response) {
            $this->response = $response;
        }

        public final function getResponse() { return $response; }

        public function getPageTitle() { return $this->pageTitle; }
        
        public function getTitle() { return $this->title; }

        //public function apply() {}

        protected abstract function drawPage();

        public function draw() {
            require_once 'App/Views/templates/header.php';
            require_once 'App/Views/templates/nav.php';

            $this->drawPage();

            require_once 'App/Views/templates/footer.php';
        }
    }

?>