<?php
    class ManagerData {
        private $package;

        public function __construct() {
            $this->package = array();
        }

        public function add(string $id, $value) {
            $this->package[$id] = $value;
            return $this;
        }

        public function remove(string $id) {
            unset($this->package[$id]);
        }

        public function get(string $id) { return $this->package[$id]; }

        public function getPackage() { return $this->package; }
    }
?>