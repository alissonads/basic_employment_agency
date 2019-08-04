<?php
    require_once 'base/AbstractModelsFactory.php';
    require_once 'App/Models/WorkerRegisterModel.php';

    class WorkerModelsFactory extends AbstractModelsFactory{
        public function createRegisterModel() {
            return new WorkerRegisterModel();
        }

        public function createUpdateModel() {

        }

        public function createProfileModel() {

        }

        public function createResultsModel() {

        }
    }
?>