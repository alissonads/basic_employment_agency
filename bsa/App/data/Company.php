<?php
    class Company {
        private $name;
        private $specialty;
        private $cnpj;

        public function __construct(string $name,
                                    string $specialty = '',
                                    string $cnpj = '') {
            $this->name = $name;
            $this->specialty = $specialty;
            $this->cnpj = $cnpj;
        }

        public function getName() { return $this->name; }

        public function getSpecialty() { return $this->specialty; }

        public function getCnpj() { return $this->cnpj; }

        public function setName(string $name) { 
            $this->name = $name; 
        }

        public function setSpecialty(string $specialty) { 
            $this->specialty = $specialty; 
        }
        
        public function setCnpj(string $cnpj) { 
            $this->cnpj = $cnpj; 
        }
    }
?>