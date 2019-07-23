<?php
    require_once 'Announcement.php';
    require_once 'Worker.php';

    class Interest {
        private $worker;
        private $announcement;
        private $date;

        public function __construct(Worker $worker, 
                                    Announcement $announcement) {
            $this->worker = $worker;
            $this->announcement = $announcement;
            $this->date = date('Y-m-d');
        }

        public function  getWorker() { return $this->worker; }
        
        public function  getAnnouncement() { return $this->announcement; }
    }

?>