<?php
    require_once 'LinkedList.php';

    class ListIterator implements Iterator {
        private $node;
        private $list;

        public function __construct(LinkedList $list) {
            $this->list = $list;
            $this->node = $this->list->getHead();
        }
    
        function rewind() {
            $this->node = $this->list->getHead();
        }
    
        function current() {
            return $this->node->getData();
        }
    
        function key() {
            $this->node;
        }
    
        function next() {
            if (!empty($this->node))
                $this->node = $this->node->getNext();
        }
    
        function valid() {
            return !empty($this->node);
        }
    }
?>