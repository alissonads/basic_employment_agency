<?php
    session_start();
    
    try {
        require_once 'App/App.php';
        
        app()->run(); 
    } catch(Exception $e) {
        echo $e->getCode() . '<br/>' . $e->getMessage();
    }

?>