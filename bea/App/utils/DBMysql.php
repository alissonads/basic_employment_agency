<?php
    class DBMysql {
        private $con;

        private function __construct($config) {
            $host = (!empty($config->host))? $config->host : '';
            $name = (!empty($config->name))? $config->name : '';
            $username = (!empty($config->username))? $config->username : '';
            $password = (!empty($config->password))? $config->password : '';
            
            $this->con = new mysqli($host, $username, $password, $name); 
                                    //or die('Could not connect to the database server ' . 
                                            //mysqli_connect_error());
            if (mysqli_connect_errno()) {
                throw new Exception('Could not connect to the database server ' . '<br/>'.
                                    'Errorno: ' . $this->con->connect_errno . '<br/>'.
                                    'Error: ' . mysqli_connect_error(), 500);
            }
        }

        public function getCon() {
            return $this->con;
        }

        public static function connect($config) {
            return new DBMysql($config);
        }

        public function disconnect() {
            $this->con->close();
        }

        public function query($query) {
            $result = $this->con->query($query);

            if (!$result) {
                throw new Exception('Error querying database.' . '<br/>'.
                                    'Errorno: ' . $this->con->errno . '<br/>'.
                                    'Error: ' . $this->con->error, 500);
            }

            return $result;
        }
    }
?>