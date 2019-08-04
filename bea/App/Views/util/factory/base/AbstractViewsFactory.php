<?php
    require_once 'App/Views/HomeView.php';
    require_once 'ViewsFactoryInterface.php';

    class AbstractViewsFactory implements ViewsFactoryInterface {
        public function createPageIndexView() {
            return new HomeView();
        }
    }
?>