<?php
    require_once 'base/AccessDBModel.php';
    require_once 'App/utils/Response.php';
    require_once 'App/utils/QueryConfig.php';
    require_once 'App/utils/User.php';
    require_once 'App/utils/GlobalDefs.php';

    class LoginLogoutModel extends AccessDBModel {
        public function __construct() {
            parent::__construct();
        }

        public function apply() {
            $currentNamePage = $this->request->getCurrentNamePage();

            if ($currentNamePage == BEA_LOGIN)
                self::login();
            else
                self::logout();
        }

        private function login() {
            self::toConsult();
        }

        private function logout() {
            removeUser();
            $page = new Page(BEA_HOME, '', REDIRECT);
            $this->response = new Response(null, $page);
            setCurrentPage($page);
        }

        private function toConsult() {
            $data = $this->request->getDataList();

            /*Faz a consulta para ver se existe o nome de usuário*/
            $result = $this->db->query("SELECT u.user_id, l.username, al.type, u.name FROM user AS u
                                        JOIN login AS l
                                        ON u.login_id = l.id
                                        JOIN access_level AS al
                                        ON u.access_id = al.id
                                        WHERE l.username = '" . trim($data['username']) . "' AND
                                              l.password = '" . trim($data['password'] . "'") );
            /*Se existir um usuário com esse username e se ele não estiver logado:
              ->Instancia o usuário na variável de sessão*/
            if ($result->num_rows == 1 && !is_object(getUser())) {
                $row = $result->fetch_assoc();
                setUser(new User($row['user_id'], $row['username'], $row['type'], $row['name']));

                $page = $this->request->getNextPage();
                $page->setInfoView($row['type']);
                $page->setAddtView(REDIRECT);
                $this->response = new Response(null, $page);
                setCurrentPage($page);
            } 
            /*senão lança o código do erro*/
            else {
                $page = new Page(BEA_LOGIN, '', REDIRECT);
                $data['error'] = 'Login ou Senha inválido!';
                $this->response = new Response($data, $page);
                setCurrentPage(new Page(BEA_HOME));
            }
        }
    }
?>