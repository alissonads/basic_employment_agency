<?php
    require_once 'Controllers/GlobalController.php';
    require_once 'Views/ManagerView.php';
    require_once 'utils/AppConfig.php';
    require_once 'utils/GlobalDefs.php';
    require_once 'utils/Page.php';
    
    define('PATH', realpath('./'));

    class App {
        private $controller;
        private $view;
        private $request;
        private $appConfig;

        private function init() {
            appConfig();

            $this->configRequest();

            $this->controller = new GlobalController();
            $this->controller->setup($this->request);
            $this->view = new ManagerView();
            $this->controller->registerObserver($this->view);
        }

        private function update() {
            $this->controller->apply();
        }

        private function draw() {
            $this->view->draw();
        }

        public function run() {
            $this->init();
            $this->update();
            $this->draw();
        }

        private function configRequest() {
            $url = $_GET['url'] ?? '';

            if (empty($url)) {
                $this->request = new Request();
                $this->request->setNextPage(new Page(BEA_HOME, HOME));
            } else {
                /*if (isset($_POST['nav-info'])) {
                    $currentPage = new Page(BEA_HOME);
                    unset($_POST['nav-info']);
                }*/
                $currentPage = !isset($_POST['nav-info']) ? getCurrentPage() : null;

                if ($temp_response = getSessionResponse()) {
                    /*tratar a resposta redirecionada*/
                    $_POST = $temp_response;
                    removeSessionResponse();
                }

                if (substr_count($url, '/') > 0) {
                    $params = explode('/', $url);
                    
                    if (count($params) > 3) {
                        throw new Exception("Error when processing the request, 
                                             the requested page doesn't exist", 404);
                    }

                    $this->request = new Request($_POST, $currentPage, 
                                                 new Page($params[0], 
                                                          $params[1]??'',
                                                          $params[2]??''));
                    /*echo '<pre> Current';
                    print_r($currentPage);
                    echo '</pre><br>';
                    echo '<pre> Next';
                    print_r($this->request->getNextPage());
                    echo '</pre>';*/
                    
                } else {
                    $this->request = new Request($_POST, $currentPage,
                                                 new Page($url));
                }
            }
        }
    }

    function app() {
        return new App();
    }
?>