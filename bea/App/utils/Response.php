<?php
    require_once 'ResponseDispatcher.php';
    require_once 'Page.php';

    class Response {
        private $data;
        private $page;

        public function __construct(array $data = null, 
                                    Page $page = null) {
            $this->data = $data;
            $this->page = $page;
        }

        public function getDataList() { return $this->data; }

        public function getValue(string $id) { return $this->data[$id]??''; }

        public function getPage() { return $this->page; }

        public function getNamePage() { return $this->page->getName(); }

        public function getPageInfoView() { return $this->page->getInfoView(); }

        public function getPageAddtInfo() { return $this->page->getAddtView(); }

        public function setData($data) { 
            $this->data = $data; 
        }

        public function setPage(Page $page) { 
            $this->page = $page; 
        }

        public function removeValue(string $id) {
            if (!empty($id))
                unset($this->data[$id]);
        }

        public function createResponseDispatcher() {
            return new ResponseDispatcher($this);
        }
    }
?>