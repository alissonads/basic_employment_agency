<?php
    class Request {
        private $data;
        private $type;

        public function __construct(array $data, $type) {
            $this->data = $data;
            $this->type = $type;
        }

        public function getDataList() { return $this->data; }

        public function getValue($id) { return $this->data[$id]; }

        public function getType() { return $this->type; }

    }
?>