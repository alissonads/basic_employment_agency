<?php
    class Address {
        private $city;
        private $state;
        private $neighborhood;
        private $cep;

        public function __construct(string $city,
                                    string $state,
                                    string $neighborhood = '',
                                    string $cep = '') {
            $this->city = $city;
            $this->state = $state;
            $this->neighborhood = $neighborhood;
            $this->cep = $cep;
        }

        public function getCity() : string { return $this->city; }
            
        public function getState() : string { return $this->state; }

        public function getNeighborhood() : string { return $this->neighborhood; }

        public function getCep() : string { return $this->cep; }

        public function setCity(string $city) {
            $this->city = $city;
        }

        public function setState(string $state) {
            $this->state = $state;
        }

        public function setNeighborhood(string $neighborhood) {
            $this->state = $neighborhood;
        }

        public function setCep(string $cep) {
            $this->cep = $cep;
        }
    }
?>