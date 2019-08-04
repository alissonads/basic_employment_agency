<?php
    require_once 'ModelsFactoryInterface.php';
    require_once 'App/Models/RedirectLinkModel.php';
    
    abstract class AbstractModelsFactory implements ModelsFactoryInterface {
        public function createLoginModel() {

        }

        public function createRedirectLinkModel() {
            return new RedirectLinkModel();
        }
    }
?>