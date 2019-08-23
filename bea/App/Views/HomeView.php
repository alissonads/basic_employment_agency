<?php
    require_once 'base/View.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/GlobalDefs.php';
    
    class HomeView extends View {
        public function __construct() {
            $this->pageTitle = 'Home'; 
        }

        public function getPageTitle() { return $this->pageTitle; }

        public function getTitle() { return $this->title; }

        protected function drawPage() {
            require_once 'util/presentation/presentation.php';
        }
    }
?>