<?php
    require_once 'GlobalDefs.php';

    class ResponseDispatcher {
        private $response;
        private $headerAtrib;

        public function __construct($response) {
            $this->response = $response;
            $this->headerAtrib = array();
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
        
        /*faz todas as configurações do cabeçalho
          antes de redirecionar*/
        private function config(string $receiver) {
            foreach ($this->headerAtrib as $key => $value) {
                header(trim($key) . ': ' . $value);
            }
            
            $namePage = $this->response->getNamePage();
            $pageInfoView = $this->response->getPageInfoView();
            $pageAddtInfo = $this->response->getPageAddtInfo();

            $url = 'http://' . HOST;
            $url .= rtrim(dirname(THIS_APP), '/\\');
            $url .= !empty($receiver)? "/$receiver" : '';
            $url .= !empty($namePage)? "/$namePage" : '';
            $url .= !empty($pageInfoView)? "/$pageInfoView" : '';
            $url .= !empty($pageAddtInfo)? "/$pageAddtInfo" : '';

            if (key_exists('Method', $this->headerAtrib) && $this->headerAtrib['Method'] == 'POST') {
                setSessionResponse($this->response->getDataList());
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