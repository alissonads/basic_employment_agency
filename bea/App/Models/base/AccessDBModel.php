<?php
    require_once 'ModelInterface.php';
    require_once 'App/utils/DBMysql.php';
    require_once 'App/utils/GlobalDefs.php';

    abstract class AccessDBModel implements ModelInterface {
        protected $db;
        protected $response;
        private $configData;

        public function __construct() {
            $this->response = null;
            $this->configData = getAppConfig()->data();
        }

        public final function getDB() {
            return $this->db;
        }

        public function getResponse() {
            return $this->response;
        }

        public function setup(Request $request) {
            //conecta-se ao banco de dados
            $this->db = DBMysql::connect($this->configData->db);

            /*if ($this->db->connect_errno) {
                throw new Exception('Could not connect to the database server ' . mysqli_connect_error());
            }*/
        }
    }
?>