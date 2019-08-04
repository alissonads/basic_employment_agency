<?php
    interface ModelInterface {
        public function getResponse();

        public function setup(Request $request);
        
        public function apply();
    }
?>