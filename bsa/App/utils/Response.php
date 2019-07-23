<?php
    class Response {
        private $data;
        private $type;
        private $code;

        public function __construct($data = '', $type = -1, $code = -1) {
            $this->data = $data;
            $this->type = $type;
            $this->code = $code;
        }

        public function getData() { return $this->data; }

        public function getType() { return $this->type; }

        public function getCode() { return $this->code; }

        public function setData($data) { 
            $this->data = $data; 
        }

        public function setType($type) { 
            $this->type = $type; 
        }

        public function setCode($code) {
            $this->code = $code;
        }
    }
?>