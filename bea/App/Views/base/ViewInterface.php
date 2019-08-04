<?php
    interface ViewInterface {
        public function getPageTitle();
        
        public function getTitle();

        public function setup(Response $response);

        //public function apply();
        
        public function draw();
    }
?>