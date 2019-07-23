<?php
    abstract class User {
        protected $cod;
        protected $accessLevel;
        protected $name;
        protected $gender;
        protected $email;

        public function __construct() {
             $this->cod = '';
             $this->accessLevel = '';
             $this->name = '';
             $this->gender = '';
             $this->email = '';
        }

        public function getCod() { return $this->cod; }

        public function getAccessLevel() { return $this->accessLevel; }

        public function getName() { return $this->name; }

        public function getGender() { return $this->gender; }

        public function getEmail() { return $this->email; }

        public function setCod(string $cod) { 
            $this->cod = $cod; 
        }

        public function setAccessLevel(string $accessLevel) { 
            $this->accessLevel = $accessLevel; 
        }

        public function setName(string $name) { 
            $this->name = $name; 
        }

        public function setGender(string $gender) { 
            $this->gender = $gender; 
        }

        public function setEmail(string $email) { 
            $this->email = $email; 
        }
    }
?>