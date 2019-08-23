<?php
    require_once 'App/App.php';

    session_start();

    try {
        app()->run(); 
    } catch(Exception $e) {
        echo $e->getCode() . '<br/>' . $e->getMessage();
    }

?>