<?php
    class DBMysql {
        private $con;

        private function __construct($config) {
            $host = (!empty($config->host))? $config->host : '';
            $name = (!empty($config->name))? $config->name : '';
            $username = (!empty($config->username))? $config->username : '';
            $password = (!empty($config->password))? $config->password : '';
            
            try {
                $this->con = new mysqli($host, $username, $password, $name); 
                                    //or die('Could not connect to the database server ' . 
                                            //mysqli_connect_error());
            } catch (mysqli_sql_exception $e) {
                throw new Exception('Could not connect to the database server ' . '<br/>'.
                                    'Errorno: ' . $this->con->connect_errno . '<br/>'.
                                    'Error: ' . $this->con->connect_error, 500);
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
            try {
                $result = $this->con->query($query);
                return $result;
            } catch (mysqli_sql_exception $e) {
                throw new Exception('Error querying database.' . '<br/>'.
                                    'Errorno: ' . $this->con->errno . '<br/>'.
                                    'Error: ' . $this->con->error, 500);
            }

            /*return $this->con->query($query)
                                or die('Error querying database.');*/
        }
    }
?>