<?php 
    class Course {
        private $type;
        private $city_state;
        private $institution;
        private $yearConclusion;
        private $name;

        public function __construct(string $type, 
                                    string $name, 
                                    string $yearConclusion, 
                                    string $institution = '', 
                                    string $city_state = '') {
            $this->type = $type;
            $this->city_state = $city_state;
            $this->institution = $institution;
            $this->yearConclusion = $yearConclusion;
            $this->name = $name;
        }

        public function getType() { return $this->type; }

        public function getCity_State() { return $this->city_state; }

        public function getInstitution() { return $this->institution; }

        public function getYearConclusion() { return $this->yearConclusion; }

        public function getName() { return $this->name; }

        public function setType(string $type) {
            $this->$type = $type;
        }

        public function setCity_state(string $city_state) {
            $this->city_state = $city_state;
        }

        public function setInstitution(string $institution) {
            $this->institution = $institution;
        }

        public function setYearConclusion(string $yearConclusion) {
            $this->yearConclusion = $yearConclusion;
        }

        public function setName(string $name) {
            $this->name = $name;
        }
    }
?>