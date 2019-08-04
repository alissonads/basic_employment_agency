<?php
    require_once 'App/utils/observer/Observer.php';
    require_once 'base/ViewInterface.php';
    require_once 'App/utils/GlobalDefs.php';
    require_once 'App/utils/Response.php';
    require_once 'HomeView.php';
    require_once 'util/factory/WorkerViewFactory.php';

    class ManagerView implements ViewInterface, Observer {
        private $view;
        private $viewsFactory;

        public function __construct() {
            $this->view = null;
            $this->viewsFactory = new WorkerViewFactory();
        }

        public function getView() {
            return $this->view;
        }

        public function getPageTitle() {
            return $this->view->getPageTitle();
        }
        
        public function getTitle() {
            return $this->view->getTitle();
        }

        public function setup(Response $response) {
            /*Cria a view*/
            $this->createView($response->getNamePage(),
                              $response->getPageInfoView());
            $this->view->setup($response);
            setCurrentPage($response->getPage());
        }

        /*public function apply() {
            $this->view->apply();
        }*/
        
        public function draw() {
            $this->view->draw();
        }

        public function update($data){
            $this->setup($data);
            //$this->apply();
        }

        private function createView(string $namePage,
                                    string $view) {
            switch ($namePage) {
                case BEA_DELETE:
                    break;
                case BEA_HOME:
                    $this->view = new HomeView();
                    break;
                case BEA_LOGIN:
                    break;
                case BEA_PROFILE:
                    break;
                case BEA_REGISTER:
                    $this->register($view);
                case BEA_RESULTS:
                    break;
                case BEA_UPDATE:
                    break;
                default:
                /*lançar a exceção*/
                    break;
            }
        }

        private function register($view) {
            switch ($view) {
                case WORKER_USER:
                    $this->view = $this->viewsFactory->createPageRegisterView();
                    break;              
                default:
                    break;
            }
        }
    }
?>