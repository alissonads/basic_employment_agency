<?php
    require_once 'Address.php';

    abstract class CorriculumAnnouncementBase {
        protected $address;
        protected $bpd;
        protected $summary;

        public function __construct() {
            $this->address = null;
            $this->bpd = array();
            $this->summary = '';
        }

        public function getAddress() { return $this->address; }

        public function isBpd() { return (empty($this->bpd) &&
                                                 count($this->bpd) > 0); }

        public function getBpd() { return $this->bpd; }

        public function getSummary() { return $this->summary; }

        public function setAddress(Address $address) { 
            $this->address = $address;
        }

        public function setSummary(string $summary) { 
            $this->summary = $summary;
        }

        public function addBpd(string $description) { 
            $this->bpd[] = $bpd;
            return $this;
        }

    }
?>