<?php
    require_once 'ModelInterface.php';

    abstract class AbstractModel implements ModelInterface{
        protected $response;

        public function __construct() {
            $this->response = null;
        }

        public function getResponse() {
            return $this->response;
        }
    }
?>