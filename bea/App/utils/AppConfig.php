<?php
    require_once 'GlobalDefs.php';

    class AppConfig {
        private $data;

        public function __construct($file = null) {
            if ($file) {
                if (is_object($data = json_decode(file_get_contents($file)))) {
                    $this->data = $data;
                }
            }
        }

        public function data() {
            return $this->data;
        }
    }

    function appConfig() {
        if (!getAppConfig()) {
            if(!file_exists(PATH . "/config.json")) {
                throw new Exception("invalid configuration file!", 500);
            }

            setAppConfig(new AppConfig(PATH . '/config.json'));
        }
    }
?>