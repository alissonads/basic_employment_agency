<?php
    class User {
        private $id;
        private $userName;
        private $accessLevel;
        private $name;

        public function __construct($id = '', 
                                    $userName = '', 
                                    $accessLevel = '',
                                    $name = '') {
            $this->id = $id;
            $this->userName = $userName;
            $this->accessLevel = $accessLevel;
            $this->name = $name;
        }

        public function getId() { return $this->id; }

        public function getUserName() { return $this->userName; }

        public function getAccessLevel() { return $this->accessLevel; }

        public function getName() { return $this->name; }
        
        public function setId($id) { 
            $this->id = $id; 
        }

        public function setUserName($userName) { 
            $this->userName = $userName; 
        }

        public function setAccessLevel($accessLevel) { 
            $this->accessLevel = $accessLevel; 
        }

        public function setName($name) { 
            $this->name = $name; 
        }
    }
?>