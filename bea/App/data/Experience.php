<?php
    require_once 'Company.php';

    class Experience {
        private $company;
        private $func;
        private $dateEntrance;
        private $dateExit;
        private $description;

        public function __construct(Company $company,
                                    string $func,
                                    string $description,
                                    string $dateEntrance = '',
                                    string $dateExit = ''     ) {
            $this->company = $company;
            $this->func = $func;
            $this->dateEntrance = $dateEntrance;
            $this->dateExit = $dateExit;
            $this->description = $description;
        }

        public function getCompany() { return $this->company; }

        public function getFunc() { return $this->func; }

        public function getDateEntrance() { return $this->dateEntrance; }

        public function getDateExit() { return $this->dateExit; }

        public function getDescription() { return $this->description; }

        public function setCompany(Company $company) {
            $this->company = $company;
        }

        public function setFunc(string $func) {
            $this->func = $func;
        }

        public function setDateEntrance(string $dateEntrance) {
            $this->dateEntrance = $dateEntrance;
        }

        public function setDateExit(string $dateExit) {
            $this->dateExit = $dateExit;
        }
            
        public function setDescription(string $description) {
            $this->description = $description;
        }
    }
?>