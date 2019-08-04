<?php
    class Page {
        private $name;
        private $infoView;
        private $addtView;

        public function __construct(string $name = '', 
                                    string $infoView = '', 
                                    string $addtInfo = '') {
            $this->name = $name;
            $this->infoView = $infoView;
            $this->addtView = $addtInfo;
        }

        public function getName() { return $this->name; }

        public function getInfoView() { return $this->infoView; }

        public function getAddtView() { return $this->addtView; }

        public function setName(string $name) { 
            $this->name = $name; 
        }

        public function setInfoView(string $infoView) { 
            $this->infoView = $infoView; 
        }

        public function setAddtView(string $addtInfo) { 
            $this->addtView = $addtInfo; 
        }
    }
?>