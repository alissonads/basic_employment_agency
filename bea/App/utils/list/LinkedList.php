<?php
    require_once 'Node.php';

    class LinkedList {
        private $head;
        private $tail;
        private $size;

        public function __construct() {
            $this->head = null;
            $this->tail = null;
            $this->size = 0;
        }

        public function getHead() { return $this->head; }

        public function getTail() { return $this->tail; }

        public function size() { return $this->size; }

        public function setHead(Node $head) { 
            $this->head = $head; 
        }

        public function setTail(Node $tail) { 
            $this->tail = $tail; 
        }

        public function removeHead() {
            $node = null;

            if (!empty($this->head)) {
                $node = $this->head->getNext();
                unset($this->head);
                $this->head = $node;

                if (empty($this->head))
                    $this->tail = null;

                $this->size--;
            }
        }

        public function removeTail() {
            $node = $this->head;

            if (!empty($this->head)) {
                if ($this->head == $this->tail) {
                    unset($this->head);
                    $this->head = null;
                    $this->tail = null;
                }
                else {
                    while ($node->getNext() != $this->tail) { 
                        $node = $node->getNext();
                    }
                    
                    $node->setNext(null);
                    unset($this->tail);
                    $this->tail = $node;
                }
                $this->size--;
            }
        }

        public function remove($data) {
            $node = $this->head;

            if (!empty($node) && !empty($data)) {
                if ($node->getData() === $data) {
                    $this->removeHead();
                }
                else {
                    $node = $node->getNext();
                    while ($node->getNext() != $this->tail) { 
                        if (!empty($node) && $node->getData() === $data) {
                            $temp = $node->getNext();
                            unset($node);
                            $node = $temp;
                            return;
                        }
                        $node = $node->getNext();
                    }
                }
            }
        }

        public  function clear() {
            while (!empty($this->head)) {
                $this->removeHead();
            }
        }

        public function pushFront($data) {
            $node = new Node($data);
            $node->setNext($this->head);
            $this->head = $node;

            if (empty($this->tail))
                $this->tail = $this->head;

            $this->size++;
        }

        public function pushBack($data) {
            if (empty($this->head)) {
                $this->pushFront($data);
            }
            else {
                $node = new Node($data);
                $this->tail->setNext($node);
                $this->tail = $node;
                $this->size++;
            }
        }
    }
?>