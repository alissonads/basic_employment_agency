<?php
    interface ViewsFactoryInterface {
        public function createPageRegisterView();

        public function createPageUpdateView();

        public function createPageLoginView();

        public function createPageProfileView();

        public function createPageVacanciesView();
    }
?>