<?php
    require_once 'ControllerInterface.php';
    require_once 'App/model/ModelInterface.php';

    class GlobalController implements ControllerInterface {
        private $model;
        private $response;

        public function getModel() {
            return $this->model;
        }
        
        public function setup($request) {
            /*$this->model = //inicializar model*/
            $this->model->setup($request);
        }
                
        public function apply() {
            $this->model->apply();
            $this->response = $this->model->getResponse();
        }
    }
?>