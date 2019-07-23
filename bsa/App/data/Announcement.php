<?php
    require_once 'CorriculumAnnouncementBase.php';
    require_once 'Company.php';
    require_once 'Collaborator.php';

    class Announcement extends CorriculumAnnouncementBase {
        private $company;
        private $advertiser;
        private $phone;
        private $phoneVisible;
        private $func;
        private $email;
        private $emailVisible;
        private $salary;
        private $amount;
        private $dateAnn;
        private $toReceiveEmail;

        public function __construct() {
            $this->company = null;
            $this->advertiser = null;
            $this->phone = '';
            $this->phoneVisible = false;
            $this->func = '';
            $this->email = '';
            $this->emailVisible = false;
            $this->salary = '';
            $this->amount = '';
            $this->dateAnn = date('Y-m-d');
            $this->toReceiveEmail = false;
        }

        public function getCompany() : Company { return $this->company; }

        public function getAdvertiser() : Collaborator { return $this->advertiser; }

        public function getPhone() : string { return $this->phone; }

        public function isPhoneVisible() : bool { return $this->phoneVisible; }

        public function getFunc() : string { return $this->func; }

        public function getEmail() : string { return $this->email; }

        public function isEmailVisible() : bool { return $this->emailVisible; }

        public function getSalary() : float { return $this->salary; }

        public function getAmount() : int { return $this->amount; }

        public function getDateAnn() : string { return $this->dateAnn; }

        public function isToReceiveEmail() : bool { return $this->toReceiveEmail; }

        public function setCompany(Company $company) {
            $this->company = $company;
            return $this;
        }

        public function setAdvertiser(Collaborator $advertiser) {
            $this->advertiser = $advertiser;
            return $this;
        }

        public function setPhone(string $phone) {
            $this->phone = $phone;
            return $this;
        }

        public function setPhoneVisible(bool $phoneVisible) {
            $this->phoneVisible = $phoneVisible;
            return $this;
        }

        public function setFunc(string $func) {
            $this->func = $func;
            return $this;
        }

        public function setEmail(string $email) {
            $this->email = $email;
            return $this;
        }

        public function setEmailVisible(bool $emailVisible) {
            $this->emailVisible = $emailVisible;
            return $this;
        }

        public function setSalary(float $salary) {
            $this->salary = $salary;
            return $this;
        }

        public function setAmount(int $amount) {
            $this->amount = $amount;
            return $this;
        }

        public function setDateAnn(string $dateAnn) {
            $this->dateAnn = $dateAnn;
            return $this;
        }

        public function setToReceiveEmail(bool $toReceiveEmail) {
            $this->toReceiveEmail = $toReceiveEmail;
            return $this;
        }
    }

?>