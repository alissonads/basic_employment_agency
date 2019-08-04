<?php
    require_once 'App/Views/WorkerRegisterView.php';
    require_once 'App/utils/Response.php';
    /*criar view*/
    $view = new WorkerRegisterView();
    $page_title = $view->getTitle();
    require_once 'App/Views/templates/header.php';
    require_once 'App/Views/templates/nav.php';

    $response = new Response();
    $response->setCode($_GET['code']);

    $view->setup($response);
    $view->apply();
    $view->draw();
    
    require_once 'App/Views/templates/footer.php'; 
?>