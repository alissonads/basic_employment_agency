<?php
    /*Request*/
    // Names Pages
    define('BEA_DELETE',   'Deletar');
    define('BEA_HOME',     'Home');
    define('BEA_LOGIN',    'Login');
    define('BEA_LOGOUT',   'Logout');
    define('BEA_PROFILE',  'Perfil');
    define('BEA_REGISTER', 'Cadastro');
    define('BEA_RESULTS',  'Resultados');
    define('BEA_UPDATE',   'Atualizar');

    // Names Views
    define('HOME',              'home');
    define('WORKER_USER',       'Trabalhador');
    define('WORKER_ADD_INFO',   'Informações Adicionais');
    define('WORKER_COURSES',    'Cursos');
    define('WORKER_EDUCATION',  'Educação');
    define('WORKER_EXPERIENCE', 'Experiências');

    //define('WORKER_USER', 'User');
    define('EMPLOYER_USER', 'Admin');

    define('COLLABORATOR_USER', 'Colaborador');
    
    define('WORK', 'Vaga');

    define('LOGIN_USER', 'Dados de Acesso');

    define('END', 'Concluir');

    define('REDIRECT', 0xFF);
    
    //Response

    define('REGISTRATION_USER' , 0x6E);
    define('REGISTRATION_ADDITIONAL_INFO', 0x6F);
    define('REGISTRATION_EXPERIENCE', 0x70);
    define('REGISTRATION_EDUCATION', 0x71);
    define('REGISTRATION_COURSE', 0x72);

    define('HOST', $_SERVER['HTTP_HOST']);
    define('THIS_APP', $_SERVER['PHP_SELF']);

    define('ROOT', 'http://' . HOST . rtrim(dirname(THIS_APP), '/\\'));
    
    function setAppConfig($appConfig) {
        $_SESSION['appConfig'] = $appConfig;
        if (!$_SESSION['appConfig'])
            removeAppConfig();
    }

    function getAppConfig() {
        return $_SESSION['appConfig'] ?? null;
    }

    function removeItemSession(string $key) {
        if (isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }

    function removeAppConfig() {
        removeItemSession('appConfig');
    }

    function setCurrentPage($currentPage) {
        $_SESSION['currentPage'] = $currentPage;
        if (!$_SESSION['currentPage'])
            removeCurrentPage();
    }

    function getCurrentPage() {
        return $_SESSION['currentPage'] ?? null;
    }

    function removeCurrentPage() {
        removeItemSession('currentPage');
    }

    /**********************************************************************/
    function setUser($user) {
        $_SESSION['user'] = $user;
        if (!$_SESSION['user'])
            removeUser();
    }

    function getUser() {
        return $_SESSION['user'] ?? null;
    }

    function removeUser() {
        removeItemSession('user');
    }

    function getUserId() {
        return is_object(getUser()) ? getUser()->getId() : '';
    }

    function getUserName() {
        return is_object(getUser()) ? getUser()->getUserName() : '';
    }

    function getAccessLevel() {
        return is_object(getUser()) ? getUser()->getAccessLevel() : '';
    }

    function getName() {
        return is_object(getUser()) ? getUser()->getName() : '';
    }
    /**********************************************************************/
    function setSessionResponse($response) {
        $_SESSION['response'] = $response;
        if (!$_SESSION['response'])
            removeSessionResponse();
    }

    function getSessionResponse() {
        return $_SESSION['response'] ?? null;
    }

    function removeSessionResponse() {
        removeItemSession('response');
    }

    function convertDateDB(string $date) {
        if (empty($date))
            return '';
        $d = explode('/', $date);
        return  $d[2] . '-' . $d[1] . '-' . $d[0];
    }

    function convertFormatMoneyDB(string $value) {
        return str_replace(',', '.', str_replace('.', '', $value));
    }
?>