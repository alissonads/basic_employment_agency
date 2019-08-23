<?php
    require_once 'ControllerInterface.php';
    require_once 'App/utils/observer/Subject.php';
    //require_once 'App/Models/ModelInterface.php';
    require_once 'App/Models/util/ManagerModels.php';
    require_once 'App/utils/Request.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/ResponseDispatcher.php';
    require_once 'App/utils/observer/Observer.php';
    require_once 'App/utils/GlobalDefs.php';

    class GlobalController implements ControllerInterface, Subject {
        private $model;
        private $observer;

        public function __construct() {
            $this->model = null;
            $this->observer = null;
        }

        public function getModel() {
            return $this->model;
        }

        public function setup(Request $request) {
            $this->model = createManagerModels()
                            ->toDesignateModel($request->getCurrentPage());
            $this->model->setup($request);
        }
                
        public function apply() {
            $this->model->apply();
            $response = $this->model->getResponse();
            
            if (!empty($response->getPage())) {
                if (!empty($response->getPageAddtInfo()) &&
                    $response->getPageAddtInfo() == REDIRECT) {

                    $response->getPage()->setAddtView('');
                    $responseDispatcher = $response->createResponseDispatcher();
                    $responseDispatcher->setContentType('text/html');
                    $responseDispatcher->addHeader('Method', 'POST');
                    /*envia a resposta para a index, ex:
                        http://localhost/param1/param2/param3
                    */
                    $responseDispatcher->despatchResponse();
                }
            }

            $this->notify();
        }

        public function registerObserver(Observer $observer) {
            $this->observer = $observer;
        }

        public function removeObserver(Observer $observer) {
            $this->observer = null;
        }

        public function notify() {
            $this->observer->update($this->model->getResponse());
        }
    }
?>