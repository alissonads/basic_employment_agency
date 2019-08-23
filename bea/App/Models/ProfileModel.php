<?php
    require_once 'base/AccessDBModel.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/QueryConfig.php';

    class ProfileModel extends AccessDBModel {
        public function __construct() {
            parent::__construct();
        }

        public function apply() {
            self::workersData();
        }

        private function workersData() {
            $result = $this->db->query("SELECT c.date_birth, u.gender, 
	                                           a.neighborhood, ct.name, ct.state
                                        FROM user AS u
                                        JOIN curriculum AS c
                                        ON u.user_id = c.user_id
                                        JOIN address AS a
                                        ON a.address_id = c.address_id
                                        JOIN city AS ct
                                        ON ct.city_id = a.city_id
                                        WHERE u.user_id = " . getUserId());
            $data = $result->fetch_assoc();

            $result = $this->db->query("SELECT ph.phone, ph.type
                                        FROM phone_contact AS ph
                                        JOIN phone_curriculum AS phc
                                        ON ph.phone_id = phc.phone_id
                                        JOIN curriculum AS c
                                        ON c.curriculum_id = phc.curriculum_id
                                        WHERE c.user_id = '" . getUserId() . "'");

            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['phone-'.$i] = $row;
                $i++;
            }

            $result = $this->db->query("SELECT email FROM user
                                        WHERE user_id = '" . getUserId() . "'");
            $data = array_merge($data, $result->fetch_assoc());

            $result = $this->db->query("SELECT f.name FROM func AS f
                                        JOIN function_curriculum AS fc
                                        ON fc.func_id = f.func_id
                                        JOIN curriculum AS c
                                        ON c.curriculum_id = fc.curriculum_id
                                        WHERE c.user_id = '" . getUserId() . "'");
            
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['intended_funcs']['func-'.$i] = $row['name'];
                $i++;
            }

            $result = $this->db->query("SELECT c.salary_pretension FROM curriculum AS c
                                        WHERE c.user_id = '" . getUserId() . "'");
            $data = array_merge($data, $result->fetch_assoc());

            $result = $this->db->query("SELECT bpd.description FROM bpd
                                        JOIN bpd_curriculum AS bpdc
                                        ON bpdc.bpd_id = bpd.bpd_id
                                        JOIN curriculum AS c
                                        ON c.curriculum_id = bpdc.curriculum_id
                                        WHERE c.user_id = '" . getUserId() . "'");
            
            if ($result->num_rows > 0)
                $data = array_merge($data, $result->fetch_assoc());

            $result = $this->db->query("SELECT l.type, e.situation,
                                               c.name, c.institution, c.year_conclusion 
                                        FROM education AS e
                                        JOIN course AS c
                                        ON c.course_id = e.course_id
                                        JOIN level AS l
                                        ON l.level_id = c.level_id
                                        JOIN education_curriculum AS ec
                                        ON ec.ed_id = e.ed_id
                                        JOIN curriculum AS crl
                                        ON crl.curriculum_id = ec.curriculum_id
                                        WHERE crl.user_id = '" . getUserId() . "'");

            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $data['educations']['ed-'.$i] = $row;
                $i++;
            }

            $result = $this->db->query("SELECT c.name, l.type, c.institution, c.year_conclusion
                                        FROM course AS c
                                        JOIN level AS l
                                        ON l.level_id = c.level_id
                                        JOIN course_curriculum AS cc
                                        ON cc.course_id = c.course_id
                                        JOIN curriculum AS crl
                                        ON crl.curriculum_id = cc.curriculum_id
                                        WHERE crl.user_id = '" . getUserId() . "'");
            
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $data['courses']['course-'.$i] = $row;
                    $i++;
                }
            }

            $result = $this->db->query("SELECT e.company_name, e.specialty,
                                               f.name, e.date_entrance, e.date_exit,
                                               e.description
                                        FROM experience AS e
                                        JOIN func AS f
                                        ON f.func_id = e.func_id
                                        JOIN experience_curriculum AS ec
                                        ON ec.exp_id = e.exp_id
                                        JOIN curriculum AS c
                                        ON c.curriculum_id = ec.curriculum_id
                                        WHERE c.user_id = '" . getUserId() . "'");
            $data = array_merge($data, $result->fetch_assoc());

            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $data['experiences']['exp-'.$i] = $row;
                    $i++;
                }
            }

            $this->response = new Response($data, $this->request->getNextPage());
        }
    }
?>