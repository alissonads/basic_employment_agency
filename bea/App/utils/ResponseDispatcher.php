<?php
    require_once 'GlobalDefs.php';

    class ResponseDispatcher {
        private $response;
        private $headerAtt;

        public function __construct($response) {
            $this->response = $response;
        }

        public function setContentType(string $value) {
            return $this->addHeader('Content-Type', $value);
        }

        public function addHeader(string $name, string $value) {
            $this->headerAtrib[$name] = $value;
            return $this;
        }

        public function getHeader(string $name) {
            return $this->headerAtrib[$name];
        }

        public function getResponse() {
            return $this->response;
        }
        
        /*faz todas as configurações deo cabeçalho
          antes de redirecionar*/
        private function config(string $receiver) {
            foreach ($this->receiver as $key => $value) {
                header($key . ': ' . $value);
            }
            
            $url = ROOT . !empty($receiver)? "/$receiver" : '';
            
            if (key_exists('Method') && $headerAtt['Method'] == 'POST') {
                setSessionResponse($this->response);
            } else {
                $url .= !empty($this->response->getNamePage())? '/' . $this->response->getNamePage() : '' .
                        !empty($this->response->getPageInfoView())? '/' . $this->response->getPageInfoView() : '' .
                        !empty($this->response->getPageAddtInfo())? '/' .  $this->response->getPageAddtInfo() : '';
            }

            return $url;
        }

        public function despatchResponse(string $receiver = '') {
            $url = $this->config($receiver);
            header('Location: ' . $url);
            exit();
        }
    }
?>