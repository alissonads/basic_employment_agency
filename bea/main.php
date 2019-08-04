<?php
    session_start();

    error_reporting(E_ALL & ~E_NOTICE);
    
    try {
        require_once 'App/Views/templates/header.php';
        require_once 'App/Views/templates/nav.php';
        require_once 'App/App.php';
        
        app()->run();

        require_once 'App/Views/templates/footer.php'; 
    } catch(Exception $e) {
        echo $e->getCode() . '<br/>' . $e->getMessage();
    }

?>