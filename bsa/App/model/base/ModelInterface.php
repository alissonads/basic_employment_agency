<?php
    interface ModelInterface {
        public function getResponse();

        public function setup($request);
        
        public function apply();
    }
?>