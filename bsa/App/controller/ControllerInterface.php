<?php

    interface ControllerInterface {
        public function setup($request);
        
        public function apply();
    }
?>