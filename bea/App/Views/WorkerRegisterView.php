<?php

    require_once 'base/View.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/GlobalDefs.php';

    class WorkerRegisterView extends View {
        private $page;

        public function __construct() {
            $this->pageTitle = 'Cadastro de Currículo'; 
        }

        public function setup($response) {
            parent::setup($response); 
            $this->page = $response->getPageAddtInfo();
            $this->setSubtitle();
        }

        private function setSubtitle() {
            if ($this->page == LOAGIN_USER)
                $this->title = 'Cadastro de Usuário';
            else
                $this->title = 'Registro de ' . $this->page;
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
            switch ($this->page) {
                case LOAGIN_USER:
                    $this->registerUser();
                    break;
                case WORKER_ADD_INFO:
                    $this->registerAdditionalInfo();
                    break;
                case WORKER_EXPERIENCE:
                    $this->registerExperience();
                    break;
                case WORKER_EDUCATION:
                    $this->educationRegister();
                    break;
                case WORKER_COURSES:
                    $this->courseRegister();
                    break;
                default:
                    throw new Exception("Página não encontrada.", 404);
                    break;
            }
        }
    }
?>