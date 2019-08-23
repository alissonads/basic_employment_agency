<?php
    require_once 'App/utils/Request.php';
    require_once 'base/ModelInterface.php';
    
    class RedirectLinkModel implements ModelInterface {
        private $request;
        private $response;

        public function __construct() {
            $this->request = null;
            $this->response = null;
        }

        public function getResponse() {
            return $this->response;
        }

        public function setup(Request $request) {
            $this->request = $request;
        }

        public function apply() {
            $this->response = new Response($this->request->getDataList(),
                                           $this->request->getNextPage());

            switch ($this->response->getPage()->getName()) {
                case BEA_LOGOUT:
                case BEA_PROFILE:
                    $this->response->getPage()->setAddtView(REDIRECT);
                    setCurrentPage($this->response->getPage());
                    break;
            }
        }
    }
?>