<?php
    require_once 'Course.php';

    class Education {
        private $course;
        private $situation;

        public function __construct(Course $course, string $situation) {
            $this->course = $course;
            $this->situation = $situation;
        }

        public function getCourse() { return $this->course; }

        public function getSituation() { return $this->situation; }

        public function getType() { return $this->course->getType(); }

        public function getCity_State() { return $this->course->getCity_State(); }

        public function getInstitution() { return $this->course->getInstitution(); }

        public function getYearConclusion() { return $this->course->getYearConclusion(); }

        public function getName() { return $this->course->getName(); }

        public function setCourse(Course $course) {
            $this->course = $course;
        }

        public function setSituation(string $situation) {
            $this->situation = $situation;
        }
    }
?>