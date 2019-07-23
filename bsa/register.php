<?php
    require_once 'App/view/WorkerRegisterView.php';
    require_once 'App/utils/Response.php';
    /*criar view*/
    $view = new WorkerRegisterView();
    $page_title = $view->getTitle();
    require_once 'App/view/templates/header.php';
    require_once 'App/view/templates/nav.php';

    $response = new Response();
    $response->setCode($_GET['code']);

    $view->setup($response);
    $view->update();
    $view->draw();
    
    require_once 'App/view/templates/footer.php'; 
?>