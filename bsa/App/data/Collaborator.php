<?php
    require_once 'User.php';
    require_once 'Company.php';
    
    class Collaborator extends User {
        private $company;

        public function __construct() {
            parent::__construct();
            $this->company;
        }

        public function getCompany() {
            return $this->company;
        }

        public function setCompany(Company $company) {
            $this->company = $company;
        }
    }
?>