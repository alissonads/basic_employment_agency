<?php
    require_once 'base/AccessDBModel.php';
    require_once 'App/utils/Request.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/QueryConfig.php';

    class WorkerRegisterModel extends AccessDBModel {
        private $request;

        public function __construct() {
            parent::__construct();
            $this->request = null;
        }

        public function setup(Request $request) {
            parent::setup(null);
            $this->request = $request;
        }

        public function apply() {
            $this->insert();
        }

        private function insert() {
            switch ($this->request->getCurrentAddtInfo()) {
                case LOAGIN_USER:
                    $this->insertUser();
                    break;
                case WORKER_ADD_INFO:
                    $this->insertAdditionalInfo();
                    break;
                case WORKER_EXPERIENCE:
                    $this->insertExperience();
                    break;
                case WORKER_EDUCATION:
                    $this->insertEducation();
                    break;
                case WORKER_COURSES:
                    $this->insertCourse();
                    $page = $this->request->getNextPage();
                    $page->setAddtView(REDIRECT);
                    $this->response = new Response(null, $page);
                    return;
                default:
                /*Lançar a Exceção*/
                    break;
            }

            $this->response = new Response(null, $this->request->getNextPage());
        }

        private function insertUser() {
            $data = $this->request->getDataList();

            $this->db->query(QueryConfig::insertLogin($data));

            $row[] = $this->db->query('SELECT id FROM login ORDER BY id DESC')->fetch_assoc();
            $row[] = $this->db->query("SELECT id FROM access_level WHERE type = 'worker'")->fetch_assoc();
            $ids = array($row[0]['id'], $row[1]['id']);

            $this->db->query(QueryConfig::insertUser($data, $ids));
        }

        private function insertAdditionalInfo() {
            //$this->response = new Response(null, BSA_REGISTER, $this->request->getNextView());
        }

        private function insertExperience() {
            //$this->response = new Response(null, BSA_REGISTER, $this->request->getNextView());
        }

        private function insertEducation() {
            //$this->response = new Response(null, BSA_REGISTER, $this->request->getNextView());
        }

        private function insertCourse() {
            //$this->response = new Response(null, BSA_PROFILE);
        }
    }
?>