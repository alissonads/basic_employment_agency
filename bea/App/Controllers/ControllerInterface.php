<?php
    interface ControllerInterface {
        public function setup(Request $request);
        
        public function apply();
    }
?>