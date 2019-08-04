<?php
    require_once 'base/ViewsFactoryInterface.php';
    require_once 'App/Views/WorkerRegisterView.php';

    class WorkerViewFactory implements ViewsFactoryInterface {
        public function createPageRegisterView() {
            return new WorkerRegisterView();
        }

        public function createPageUpdateView() {

        }

        public function createPageLoginView() {

        }

        public function createPageProfileView() {

        }

        public function createPageVacanciesView() {

        }
    }
?>