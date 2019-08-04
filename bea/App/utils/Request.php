<?php
    require_once 'Page.php';
    
    class Request {
        private $data;
        private $currentPage;
        private $nextPage;

        public function __construct(array $data = null, 
                                    Page $currentPage = null,
                                    Page $nextPage = null) {
            $this->data = $data;
            $this->currentPage = $currentPage;
            $this->nextPage = $nextPage;
        }

        public function getDataList() { return $this->data; }

        public function getValue(string $id) { return $this->data[$id]; }

        public function getCurrentPage() { return $this->currentPage; }

        public function getNextPage() { return $this->nextPage; }

        public function getCurrentNamePage() { return $this->currentPage->getName(); }

        public function getCurrentInfoView() { return $this->currentPage->getInfoView(); }

        public function getCurrentAddtInfo() { return $this->currentPage->getAddtView(); }

        public function getNextNamePage() { return $this->nextPage->getName(); }

        public function getNextInfoView() { return $this->nextPage->getInfoView(); }

        public function getNextAddtInfo() { return $this->nextPage->getAddtView(); }

        public function setDataList(array $data) { 
            $this->data = $data; 
        }

        public function setCurrentPage(Page $currentPage) { 
            $this->currentPage = $currentPage; 
        }

        public function setNextPage(Page $nextPage) { 
            $this->nextPage = $nextPage; 
        }

        public function removeValue(string $id) {
            unset($this->data[$id]);
        }
    }
?>