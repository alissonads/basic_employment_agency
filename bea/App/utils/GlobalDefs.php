<?php
    /*Request*/
    // Names Pages
    define('BEA_DELETE',   'Deletar');
    define('BEA_HOME',     'Home');
    define('BEA_LOGIN',    'Login');
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
    define('EMPLOYER_USER', 'Empregador');

    define('COLLABORATOR_USER', 'Colaborador');
    
    define('WORK', 'Vaga');

    define('LOAGIN_USER', 'Dados de Acesso');

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

    function setAppConfig($appConfig) {
        $_SESSION['appConfig'] = $appConfig;
        removeAppConfig();
    }

    function getAppConfig() {
        return $_SESSION['appConfig'] ?? null;
    }

    function removeItemSession(string $key) {
        if (isset($_SESSION[$key]) || !$_SESSION[$key])
            unset($_SESSION[$key]);
    }

    function removeAppConfig() {
        removeItemSession('appConfig');
    }

    function setCurrentPage($currentPage) {
        $_SESSION['currentPage'] = $currentPage;
        removeCurrentPage();
    }

    function getCurrentPage() {
        return $_SESSION['currentPage'] ?? null;
    }

    function removeCurrentPage() {
        removeItemSession('currentPage');
    }

    function setUserId($userId) {
        $_SESSION['user_id'] = $userId;
        removeUserId();
    }

    function getUserId() {
        return $_SESSION['user_id'] ?? '';
    }

    function removeUserId() {
        removeItemSession('user_id');
    }

    function setSessionResponse($response) {
        $_SESSION['response'] = $response;
        removeSessionResponse();
    }

    function getSessionResponse() {
        return $_SESSION['response'] ?? null;
    }

    function removeSessionResponse() {
        removeItemSession('response');
    }
?>