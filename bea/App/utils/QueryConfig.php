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
            
            $values = "DEFAULT, '".  trim($data['username'])  ."', '" . $data['password'] ."'";
            return self::insert('login', 'id, username, password', $values);
        }

        public static function insertUser(array $data, array $ids) {
            $values = "DEFAULT, '" . $ids[0] . "', '" . $ids[1] . "', " .
                      "'".  trim($data['name'])  ."', '" . $data['gender'] ."', '" . 
                      trim($data['email']) ."'";
            return self::insert('user', 
                                'user_id, login_id, access_id, name, gender, email', 
                                $values);
        }

        public static function insertCity(array $data) {
            $values = "DEFAULT, '" . trim($data[0]) . "', '" . trim($data[1]) . "'";
            return self::insert('city',
                                'city_id, name, state',
                                $values);
        }

        public static function insertAddress($neighborhood, int $cityId) {
            $values = "DEFAULT, '$cityId', '$neighborhood'";
            return self::insert('address',
                                'address_id, city_id, neighborhood',
                                $values);
        }

        public static function insertCurriculum(array $data, int $addressId) {
            $values = "DEFAULT, '" . getUserId() . "', '$addressId', '" . 
                       $data['date_birth'] . "', '" . $data['salary_pretension'] . "', '', '" . 
                       $data['summary'] . "', '" . $data['isbpd'] . "', '" . 
                       $data['marital_status'] . "'";
            return self::insert('curriculum', '', $values);
        }

        public static function insertPhone($phone, int $type = 1) {
            $values = "DEFAULT, '$type', '$phone'";
            return self::insert('phone_contact', '', $values);
        }

        public static function insertFunc(string $func) {
            $values = "DEFAULT, '$func'";
            return self::insert('func', '', $values);
        }

        public static function insertDeficiency(string $deficiency) {
            $values = "DEFAULT, '$deficiency'";
            return self::insert('bpd', '', $values);
        }

        public static function insertExperience(array $data, int $funcId) {
            $dateExit = convertDateDB($data[3]);
            $dateExit = !empty($dataExit)? "'$dataExit'" : 'NULL';
            $values = "DEFAULT, '$funcId', '" . trim($data[0]) . "', '" .
                       trim($data[4]) . "', '" . convertDateDB($data[2]) . "', " .
                       $dateExit . ", '" . trim($data[5]) . "'";
            return self::insert('experience', '', $values);
        }

        public static function insertCourse(array $data, int $levelId, int $cityId) {
            $values = "DEFAULT, '$levelId', '$cityId', '" .
                       trim($data[0]) . "', '" . trim($data[1]) . "', '" . 
                       trim($data[2]) . "'";
            return self::insert('course', '', $values);
        }

        public static function insertEducation(int $courseId, string $situation) {
            $values = "DEFAULT, '$courseId', '" . trim($situation) . "'";
            return self::insert('education', '', $values);
        }

        public static function joinCurriculum(string $table, int $curriculumId, int $otherId) {
            $values = "DEFAULT, '$curriculumId', '$otherId'";
            return self::insert($table, '', $values);
        }
    }
?>