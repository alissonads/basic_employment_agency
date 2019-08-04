<?php
    require_once 'CorriculumAnnouncementBase.php';
    require_once 'Course.php';
    require_once 'Education.php';
    require_once 'Experience.php';

    class Curriculum extends CorriculumAnnouncementBase {
        private $dateBirth;
        private $salaryPretension;
        private $path;
        private $maritalStatus;
        private $phones;
        private $courses;
        private $experiences;
        private $education;
        private $funcs;

        public function __construct() {
            $this->dateBirth = '';
            $this->salaryPretension = '';
            $this->path = '';
            $this->maritalStatus = '';
            $this->phones = array();
            $this->courses = array();
            $this->experiences = array();
            $this->education = null;
            $this->funcs = array();
        }

        public function getDateBirth() { return $this->dateBirth; }

        public function getSalaryPretension() { return $this->salaryPretension; }

        public function getPath() { return $this->path; }

        public function getMaritalStatus() { return $this->maritalStatus; }

        public function getPhones() { return $this->phones; }

        public function getPhone(string $id) { return $this->phones[$id]; }

        public function getCourses() { return $this->courses; }

        public function getCourse(int $id) { return $this->courses[$id]; }

        public function getExperiences() { return $this->experiences; }

        public function getExperience(int $id) { return $this->experiences[$id]; }

        public function getEducation() { return $this->education; }

        public function getFuncs() { return $this->funcs; }

        public function setDateBirth(string $dateBirth) { 
            $this->dateBirth = $dateBirth; 
        }

        public function setSalaryPretension(float $salaryPretension) { 
            $this->salaryPretension = $salaryPretension; 
        }

        public function setPath(string $path) { 
            $this->path = $path; 
        }

        public function setMaritalStatus(string $maritalStatus) { 
            $this->maritalStatus = $maritalStatus; 
        }

        public function setEducation(Education $education) { 
            $this->education = $education; 
        }

        public function setCourses(array $courses) { 
            $this->courses = $courses; 
            return $this;
        }

        public function setExperiences(array $experiences) { 
            $this->experiences = $experiences; 
            return $this;
        }

        public function addPhone(string $type, string $phone) { 
            $this->phones[$type] = $phone; 
            return $this;
        }

        public function addCourse(Course $course)  { 
            $this->courses[] = $course; 
            return $this;
        }

        public function addExperience(Experience $experience) { 
            $this->experiences[] = $experience; 
            return $this;
        }


        public function addFunc($func) { 
            $this->funcs[] = $func; 
            return $this;
        }
    }
?>