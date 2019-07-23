<?php
    interface ViewInterface {
        public function getPageTitle();
        
        public function getTitle();

        public function setup($response);

        public function update();
        
        public function draw();
    }
?>