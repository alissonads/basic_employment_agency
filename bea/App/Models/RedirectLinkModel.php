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
            $this->response = new Response(null,
                                           $this->request->getNextPage());
        }
    }
?>