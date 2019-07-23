<?php
    require_once 'base/View.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/AppConsts.php';

    class IndexView extends View {
        public function __construct() {
            $this->pageTitle = 'Início'; 
        }

        public function getPageTitle() { return $this->pageTitle; }

        public function getTitle() { return $this->title; }

        protected function drawPage() {
            
        }
    }
?>