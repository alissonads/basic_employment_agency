<?php
    interface ModelsFactoryInterface {
        public function createRegisterModel();

        public function createUpdateModel();

        public function createLoginModel();

        public function createProfileModel();

        public function createResultsModel();

        public function createRedirectLinkModel();
    }
?>