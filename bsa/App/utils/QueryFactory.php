<?php
    define (INSERT, 0);
    define (UPDATE, 1);
    define (SELECT, 2);

    interface QueryFactory {
        public function createRequest($package, int $requestType = -1) : string;
    }
?>