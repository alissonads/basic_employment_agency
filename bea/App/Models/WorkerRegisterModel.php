<?php
    require_once 'base/AccessDBModel.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/QueryConfig.php';

    class WorkerRegisterModel extends AccessDBModel {
        private $curriculumId;

        public function __construct() {
            parent::__construct();
        }

        public function apply() {
            $this->insert();
        }

        private function insert() {
            switch ($this->request->getCurrentAddtInfo()) {
                case LOGIN_USER:
                    $this->insertUser();
                    break;
                case WORKER_ADD_INFO:
                    $this->insertAdditionalInfo();
                    break;
                case WORKER_EXPERIENCE:
                    $this->insertExperience();
                    break;
                case WORKER_EDUCATION:
                    $this->insertEducation();
                    break;
                case WORKER_COURSES:
                    $this->insertCourse();
                    $page = $this->request->getNextPage();
                    $page->setAddtView(REDIRECT);
                    $this->response = new Response(null, $page);
                    setCurrentPage($page);
                    //$this->response = new Response(null, $this->request->getCurrentPage());
                    return;
                default:
                /*Lançar a Exceção*/
                    break;
            }

            $this->response = new Response(null, $this->request->getNextPage());
        }

        private function insertUser() {
            $data = $this->request->getDataList();

            $this->db->query(QueryConfig::insertLogin($data));

            $row[] = $this->db->query("SELECT id FROM login
                                       WHERE username = '" . $data['username'] . "'")->fetch_assoc();
            $row[] = $this->db->query("SELECT id FROM access_level WHERE type = '" . WORKER_USER . "'")->fetch_assoc();
            $ids = array($row[0]['id'], $row[1]['id']);
            
            $this->db->query(QueryConfig::insertUser($data, $ids));

            $row = $this->db->query("SELECT u.user_id, u.name FROM user AS u
                                     INNER JOIN login as l
                                     WHERE l.username = '" . $data['username'] . "'")->fetch_assoc();
            setUserId($row['user_id']);
            setUserName($row['name']);
        }

        private function insertAdditionalInfo() {
            /*Configura os dados passados pelo usuário*/
            $data = self::configValues();
            //echo '<pre>';
            //print_r($data);
            //echo '</pre><br>';
            /*cadastra o endereço (cidade/estado, bairro)*/
            $addressId = self::insertAddress($data);

            /*Cadastra o curriculo*/
            $this->db->query(QueryConfig::insertCurriculum($data, $addressId));
            //echo QueryConfig::insertCurriculum($data, $addressId??1) . '<br>';
            /*Faz a consulta para pegar o curriculum referente ao usuário da sessão*/            /*consulta o id do curriculo*/
            self::selectCurriculumId();
            
            /*cadastra o telefone celular*/
            self::insertPhone($data['cellular']);

            /*se existir um telefone residencial cadastra-o*/
            if (!empty($data['residential']))
                self::insertPhone($data['residential'], $data['observation']??3);

            /*cadastra as funções pretendidas*/
            self::insertFuncs($data['funcs']);

            /*cadastra as deficiências se possuir*/
            if (!empty($data['resume-deficiency']))
                self::insertDeficiency($data['resume-deficiency']);
        }

        private function insertExperience() {
            $data = $this->request->getDataList();

            foreach ($data as $key => $value) {
                $data[$key] = explode('|', $value);
            }

            foreach ($data as $key => $value) {
                /*Insere a função e pega o seu id*/
                $funcId = self::insertFunc($value[1]);

                
                $this->db->query(QueryConfig::insertExperience($value, $funcId));

                /*consulta o id da experiência que foi inserida*/
                $row = $this->db->query("SELECT exp_id FROM experience 
                                         WHERE func_id = '$funcId' AND
                                               company_name = '" . trim($value[0]) . "' AND
                                               specialty = '" . trim($value[4]) . "' AND
                                               description = '" . trim($value[5]) . "'
                                        LIMIT 1" )->fetch_assoc();
                /*consulta o id do curriculo*/
                self::selectCurriculumId();
                /*Junta com o curriculum no banco de dados*/
                $this->db->query(QueryConfig::joinCurriculum('experience_curriculum', $this->curriculumId, $row['exp_id']));
            }
        }

        private function insertEducation() {
            $data = $this->request->getDataList();

            foreach ($data as $key => $value) {
                $data[$key] = explode('|', $value);
                $data[$key][0] = explode(' ', $data[$key][0]);
                if (!empty($data[$key][4]))
                    $data[$key][4] = explode('/', $data[$key][4]);
            }

            foreach ($data as $key => $value) {
                $courseId = self::inCourseEd($value);
                self::inEducation($courseId, $value[0][1]);
            }
        }

        private function insertCourse() {
            $data = $this->request->getDataList();

            foreach ($data as $key => $value) {
                $data[$key] = explode('|', $value);
                $data[$key][4] = explode('/', $data[$key][4]);
            }

            /*consulta o id do curriculo*/
            self::selectCurriculumId();

            foreach ($data as $key => $value) {
                $courseId = self::inCourse($value);
                /*Junta com o curriculum no banco de dados*/
                $this->db->query(QueryConfig::joinCurriculum('course_curriculum', $this->curriculumId, $courseId));
            }
        }

        private function configValues() {
            //$this->response = new Response(null, BSA_REGISTER, $this->request->getNextView());
            $data = $this->request->getDataList();
            /*Separa as funções desejadas que estavão em uma string explodindo ela*/
            $data['funcs'] = (substr_count($data['funcs'], '|') > 0)? explode('|', $data['funcs']) : array(trim($data['funcs']));
            /*Se possuir deficiência e estiver os detalhes, separa-os os dados que estão
              em uma string explodindo-os e transformando em array */
            if (isset($data['isbpd'])) {
                if (isset($data['resume-deficiency']))
                    $data['resume-deficiency'] = (substr_count($data['resume-deficiency'], ',') > 0)? 
                                                    explode(',', $data['resume-deficiency']) : array($data['resume-deficiency']);
            } else {
                $data['isbpd'] = 0;
            }

            /*Separa o nome da Cidade e do Estado*/
            $data['city_state'] = explode('/', $data['city_state']);
            $data['date_birth'] = convertDateDB($data['date_birth']);
            $data['salary_pretension'] = convertFormatMoneyDB($data['salary_pretension']);

            return $data;
        }

        private function selectCurriculumId() {
            $row = $this->db->query("SELECT c.curriculum_id FROM curriculum AS c
                                     JOIN user
                                     ON c.user_id = '" . getUserId() . "'")->fetch_assoc();
            $this->curriculumId = $row['curriculum_id'];
        }

        private function insertCity(array $data) {
            /*Faz a consulta para ver se existe uma cidade do mesmo nome e stado*/
            $result = $this->db->query("SELECT city_id FROM city 
                                        WHERE name = '" . trim($data[0]) . "' AND 
                                              state = '" . trim($data[1]) . "'" );
            /*Se não existir a cidade cadastra a nova cidade
              e pega o identificador da cidade para o endereço*/
            if ($result->num_rows < 1) {
                $this->db->query(QueryConfig::insertCity($data));

                $result = $this->db->query("SELECT city_id FROM city 
                                            WHERE name = '" . trim($data[0]) . "' AND 
                                                  state = '" . trim($data[1]) . "'" );
                $row = $result->fetch_assoc();
                $cityId = $row['city_id'];
            } 
            /*se existir pega o identificador da cidade para o endereço*/
            else {
                $row = $result->fetch_assoc();
                $cityId = $row['city_id'];
            }

            return $cityId;
        }

        private function insertAddress(array $data) {
            $cityId = self::insertCity($data['city_state']);

            /*Faz a consulta para ver se existe o endereço com esse bairro e cidade*/
            $result = $this->db->query("SELECT address_id FROM address 
                                        WHERE city_id = '$cityId' AND 
                                              neighborhood = '" . trim($data['neighborhood']) . "'" );
            /*Se não existir o endereço, cadastra o novo endereço
              e pega o identificador do endereço para o curriculo*/
            if ($result->num_rows < 1) {
                $this->db->query(QueryConfig::insertAddress($data['neighborhood'], $cityId));

                $result = $this->db->query("SELECT address_id FROM address 
                                            WHERE city_id = '$cityId' AND 
                                                  neighborhood = '" . trim($data['neighborhood']) . "'" );
                $row = $result->fetch_assoc();
                $addressId = $row['address_id'];
            }
            /*se existir pega o identificador do endereço para o curriculo*/ 
            else {
                $row = $result->fetch_assoc();
                $addressId = $row['address_id'];
            }

            return $addressId;
        }

        private function insertPhone(string $phone, int $type = 1) {
            /*Faz a consulta para ver se existe o telefone em questão*/
            $result = $this->db->query("SELECT phone_id FROM phone_contact 
                                        WHERE phone = '" . trim($phone) . "'" );
            /*Se não existir o telefone, cadastra o novo telefone
              e pega o identificador do telefone para o juntar com o curriculo*/
            if ($result->num_rows < 1) {
                $this->db->query(QueryConfig::insertPhone($phone, $type));

                $result = $this->db->query("SELECT phone_id FROM phone_contact 
                                            WHERE phone = '" . trim($phone) . "'" );
                $row = $result->fetch_assoc();
                $phoneId = $row['phone_id'];
            }
            /*se existir pega o identificador do telefone para o juntar com o curriculo*/ 
            else {
                $row = $result->fetch_assoc();
                $phoneId = $row['phone_id'];
            }
            
            /*Junta com o curriculum no banco de dados*/
            $this->db->query(QueryConfig::joinCurriculum('phone_curriculum', $this->curriculumId, $phoneId));
        }

        private function insertFuncs(array $funcs) {
            foreach ($funcs as $key => $value) {
                /*Faz a consulta para ver se existe a função referente*/
                /*$result = $this->db->query("SELECT func_id FROM func 
                                            WHERE name = '" . trim($value) . "'" );
                /*Se não existir a função, cadastra uma nova função
                  e pega o identificador dessa função para o juntar com o curriculo*/
                /*if ($result->num_rows < 1) {
                    $this->db->query(QueryConfig::insertFunc(trim($value)));
                    $result = $this->db->query("SELECT func_id FROM func 
                                                WHERE name = '" . trim($value) . "'" );
                    $row = $result->fetch_assoc();
                    $funcId = $row['func_id'];
                }
                /*se existir pega o identificador dessa função para o juntar com o curriculo*/ 
                /*else {
                    $row = $result->fetch_assoc();
                    $funcId = $row['func_id'];
                }*/
                $funcId = self::insertFunc($value);
                /*Junta com o curriculum no banco de dados*/
                $this->db->query(QueryConfig::joinCurriculum('function_curriculum', $this->curriculumId, $funcId));
            }
        }

        private function insertFunc(string $func) {
            /*Faz a consulta para ver se existe a função referente*/
            $result = $this->db->query("SELECT func_id FROM func 
                                        WHERE name = '" . trim($func) . "'" );
            /*Se não existir a função, cadastra uma nova função
                 e pega o identificador dessa função para o juntar com a experiência*/
            if ($result->num_rows < 1) {
                $this->db->query(QueryConfig::insertFunc(trim($func)));
                $result = $this->db->query("SELECT func_id FROM func 
                                                WHERE name = '" . trim($func) . "'" );
                $row = $result->fetch_assoc();
                $funcId = $row['func_id'];
            }
            /*se existir pega o identificador dessa função para o juntar com a experiência*/ 
            else {
                $row = $result->fetch_assoc();
                $funcId = $row['func_id'];
            }

            return $funcId;
        }

        private function insertDeficiency(array $data) {
            foreach ($data as $key => $value) {
                $result = $this->db->query("SELECT bpd_id FROM bpd 
                                            WHERE description = '" . trim($value) . "'" );
                /*Se não existir a deficiência, cadastra uma nova deficiência
                  e pega o identificador dessa deficiência para o juntar com o curriculo*/
                if ($result->num_rows < 1) {
                    $this->db->query(QueryConfig::insertDeficiency(trim($value)));
                    $result = $this->db->query("SELECT bpd_id FROM bpd 
                                                WHERE description = '" . trim($value) . "'" );
                    $row = $result->fetch_assoc();
                    $bpdId = $row['bpd_id'];
                } 
                /*se existir pega o identificador dessa deficiência para o juntar com o curriculo*/ 
                else {
                    $row = $result->fetch_assoc();
                    $bpdId = $row['bpd_id'];
                }

                /*Junta com o curriculum no banco de dados*/
                $this->db->query(QueryConfig::joinCurriculum('bpd_curriculum', $this->curriculumId, $bpdId));
            }
        }

        private function inCourseEd(array $data) {
            $row = $this->db->query("SELECT level_id FROM level
                                     WHERE type = '" . 
                                           trim($data[0][0]) . "'")->fetch_assoc();
            $levelId = $row['level_id'];

            /*Se a opção de cidade/estado não estiver vazia,
              seleciona o identificador da cidade se existir,
              se não existir insere uma nova cidade e seleciona deu id*/
            if (!empty($data[4]))
                $cityId = self::insertCity($data[4]);
            /*Se a opção for vazia por padrão recebe 1, 
              que é uma cidade vazia*/
            else
                $cityId = 1;

            $values = array(trim($data[1]), trim($data[2]), trim($data[3]));
            $result = $this->db->query("SELECT course_id FROM course
                                        WHERE level_id = '$levelId' AND
                                              city_id = '$cityId' AND
                                              institution = '" . $values[0] . "' AND
                                              name = '" . $values[1] . "' AND
                                              year_conclusion = '" . $values[2] . "'");
            if ($result->num_rows < 1) {
                                                            /*array(institution, name, year_conclusion)*/                    
                $this->db->query(QueryConfig::insertCourse($values, $levelId, $cityId));
                $result = $this->db->query("SELECT course_id FROM course
                                            WHERE level_id = '$levelId' AND
                                                  city_id = '$cityId' AND
                                                  institution = '" . $values[0] . "' AND
                                                  name = '" . $values[1] . "' AND
                                                  year_conclusion = '" . $values[2] . "'");
                $row = $result->fetch_assoc();
                $courseId = $row['course_id'];
            } else {
                $row = $result->fetch_assoc();
                $courseId = $row['course_id'];
            }

            return $courseId;
        }

        private function inEducation(int $courseId, string $situation) {
            $result = $this->db->query("SELECT ed_id FROM education
                                        WHERE course_id = '$courseId' AND
                                              situation = '" . trim($situation) . "'");

            if ($result->num_rows < 1) {
                $this->db->query(QueryConfig::insertEducation($courseId, $situation));

                $result = $this->db->query("SELECT ed_id FROM education
                                            WHERE course_id = '$courseId' AND
                                                  situation = '" . trim($situation) . "'");
                $row = $result->fetch_assoc();
                $edId = $row['ed_id'];
            } else {
                $row = $result->fetch_assoc();
                $edId = $row['ed_id'];
            }
            /*consulta o id do curriculo*/
            self::selectCurriculumId();
            /*Junta com o curriculum no banco de dados*/
            $this->db->query(QueryConfig::joinCurriculum('education_curriculum', $this->curriculumId, $edId));
        }

        private function inCourse(array $data) {
            /*Seleciona o id do level referente ao curso*/
            $row = $this->db->query("SELECT level_id FROM level
                                     WHERE type = '" . 
                                           trim($data[0]) . "'")->fetch_assoc();
            $levelId = $row['level_id'];

            /*Se a opção de cidade/estado não estiver vazia,
              seleciona o identificador da cidade se existir,
              se não existir insere uma nova cidade e seleciona deu id*/
            if (!empty($data[4]))
                $cityId = self::insertCity($data[4]);
            /*Se a opção for vazia por padrão recebe 1, 
              que é uma cidade vazia*/
            else
                $cityId = 1;

            /*Seleciona o id do curso para ver se existe os dados que o usuário enviou*/
            $result = $this->db->query("SELECT course_id FROM course
                                        WHERE level_id = '$levelId' AND
                                              city_id = '$cityId' AND
                                              institution = '" . trim($data[1]) . "' AND
                                              name = '" . trim($data[2]) . "' AND
                                              year_conclusion = '" . trim($data[3]) . "'");
            /*Se os dados não existirem*/
            if ($result->num_rows < 1) {
                /*organiza os dados em um array
                               array(institution, nome do curso, ano de conclusão)*/
                $values = array(trim($data[1]), trim($data[2]), trim($data[3]));
                /*Insere os dados*/
                $this->db->query(QueryConfig::insertCourse($values, $levelId, $cityId));
                /*Seleciona o id do curso que foi cadastrado*/
                $result = $this->db->query("SELECT course_id FROM course
                                            WHERE level_id = '$levelId' AND
                                                  city_id = '$cityId' AND
                                                  institution = '" . trim($data[1]) . "' AND
                                                  name = '" . trim($data[2]) . "' AND
                                                  year_conclusion = '" . trim($data[3]) . "'");

                $row = $result->fetch_assoc();
                $courseId = $row['course_id'];
            } 
            /*Se existirem, pega o id*/
            else {
                $row = $result->fetch_assoc();
                $courseId = $row['course_id'];
            }

            return $courseId;
        }
    }
?>