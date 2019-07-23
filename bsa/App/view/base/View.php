<?php
    require_once 'ViewInterface.php';

    abstract class View implements ViewInterface {
        protected $response;

        public function setup($response) {
            $this->response = $response;
        }

        public final function getResponse() {
            return $response;
        }

        public function update() {}

        protected abstract function drawPage();

        public function draw() {
            $this->drawPage();
        }
    }

?>