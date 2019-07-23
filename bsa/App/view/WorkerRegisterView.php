<?php
    require_once 'base/View.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/AppConsts.php';

    class WorkerRegisterView extends View {
        private $pageTitle;
        private $title;
        private $code;

        public function __construct() {
            $this->pageTitle = 'Cadastro de Currículo'; 
        }

        public function setup($response) {
            parent::setup($response); 
            $this->code = $response->getCode();
            $this->setSubtitle();
        }

        public function getPageTitle() { return $this->pageTitle; }

        public function getTitle() { return $this->title; }

        private function setSubtitle() {
            switch ($this->code) {
                case REGISTRATION_USER:
                    $this->title = 'Cadastro de Usuário';
                    break;
                case REGISTRATION_ADDITIONAL_INFO:
                    $this->title = 'Informações Adicionais';
                    break;
                case REGISTRATION_EXPERIENCE:
                    $this->title = 'Registro de Experiências';
                    break;
                case REGISTRATION_EDUCATION:
                    $this->title = 'Registro de Educação';
                    break;
                case REGISTRATION_COURSE:
                    $this->title = 'Registro de Cursos';
                    break;
            }
        }

        private function courseRegister() {
            require_once 'util/course_register.php';
        }

        private function educationRegister() {
            require_once 'util/education_register.php';
        }

        private function registerAdditionalInfo() {
            require_once 'util/register_additional_info.php';
        }

        private function registerExperience() {
            require_once 'util/register_experience.php';
        }

        private function registerUser() {
            require_once 'util/register_user.php';
        }

        protected function drawPage() {
            switch ($this->code) {
                case REGISTRATION_USER:
                    $this->registerUser();
                    break;
                case REGISTRATION_ADDITIONAL_INFO:
                    $this->registerAdditionalInfo();
                    break;
                case REGISTRATION_EXPERIENCE:
                    $this->registerExperience();
                    break;
                case REGISTRATION_EDUCATION:
                    $this->educationRegister();
                    break;
                case REGISTRATION_COURSE:
                    $this->courseRegister();
                    break;
            }
        }
    }
?>