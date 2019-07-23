<?php
    class ResponseDispatcher {
        private $receiver;
        private $headerAtrib;

        public function __construct(string $receiver) {
            $this->receiver = $receiver;
        }

        public function setContentType(string $value) {

        }

        public function setReceiver(string $receiver) {
            $this->receiver = $receiver;
        }

        public function addHeader(string $name, string $value) {
            $this->headerAtrib[$name] = $value;
            return $this;
        }

        public function getHeader(string $name) {
            return $this->headerAtrib[$name];
        }

        public function getReceiver() {
            return $this->receiver;
        }
        
        public function despatchResponse($response) {
            
        }
    }
?>