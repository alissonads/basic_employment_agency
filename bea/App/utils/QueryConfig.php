<?php
    class QueryConfig {
        public function toOrganize(array $data) {
        }

        public static function delete(string $table, string $where) {
            return "DELETE FROM $table WHERE $where";
        }

        public static function insert(string $table, string $cols, string $values) {
            $c = !empty($cols)? "($cols)" : '';
            return "INSERT INTO $table $c VALUES ($values)";
        }

        public static function update(string $table, string $values) {
            return "UPDATE $table SET $values";
        }

        public static function insertLogin(array $data) {
            /*$query = "INSERT INTO login (id, username, password)
                      VALUES (DEFAULT, '" . $data['username'] ."', '" . $data['password'] ."')";
            return $query;*/
            
            $values = "DEFAULT, '". $data['username']  ."', '" . $data['password'] ."'";
            return self::insert('login', 'id, username, password', $values);
        }

        public static function insertUser(array $data, array $ids) {
            /*$query = "INSERT INTO user (user_id, login_id, access_id, name, gender, email)
                      VALUES (DEFAULT, '" . $ids[0] . "', '" . $ids[1] . "', " .
                      "'". $data['name']  ."', '" . $data['gender'] ."', " . 
                      "'" . $data['email'] ."')";
            return $query;*/

            $values = "DEFAULT, '" . $ids[0] . "', '" . $ids[1] . "', " .
                      "'". $data['name']  ."', '" . $data['gender'] ."', '" . 
                      $data['email'] ."'";
            return self::insert('user', 
                                'user_id, login_id, access_id, name, gender, email', 
                                $values);
        }
    }
?>