<?php
    require_once 'User.php';
    require_once 'Curriculum.php';
    
    class Worker extends User {
        private $curriculum;

        public function __construct() {
            parent::__construct();
            $this->curriculum = null;
        }

        public function getCurriculum() {
            return $this->curriculum;
        }

        public function setCurriculum(Curriculum $curriculum) {
            $this->curriculum = $curriculum;
        }
    }

?>