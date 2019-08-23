<?php
    require_once 'App/Models/util/factory/WorkerModelsFactory.php';
    require_once 'App/Models/ProfileModel.php';
    require_once 'App/Models/LoginLogoutModel.php';
    require_once 'App/utils/GlobalDefs.php';
    require_once 'App/utils/Page.php';

    class ManagerModels {
        private $factory;

        public function __construct() {
            $this->factory = null;
        }

        public function getFactory() { $this->factory; }

        public function toDesignateModel(Page $currentPage = null) {
            return $this->createModel($currentPage);
        }

        private function createModel(Page $currentPage = null) {
            if (!$currentPage) {
                return $this->redirectLinkModel();
            }

            $currentNamePage = $currentPage->getName();
            $currentViewInfo = $currentPage->getInfoView();

            switch ($currentNamePage) {
                case BEA_DELETE:
                    break;
                case BEA_HOME:
                    return $this->redirectLinkModel($currentViewInfo);
                case BEA_LOGIN:
                case BEA_LOGOUT:
                    return new LoginLogoutModel();
                case BEA_PROFILE:
                    return new ProfileModel();
                case BEA_REGISTER:
                    return $this->registerModel($currentViewInfo);
                case BEA_RESULTS:
                    break;
                case BEA_UPDATE:
                    break;
                default:
                /*lançar a exceção*/
                    break;
            }
        }

        private function registerModel(string $currentViewInfo) {
            switch ($currentViewInfo) {
                case WORKER_USER:
                    $this->factory = new WorkerModelsFactory();
                    return $this->factory->createRegisterModel();
                /*fazer as outras verificações*/
                default:
                    /*lançar a exceção*/
                    break;
            }
        }

        private function redirectLinkModel(string $currentViewInfow = '') {
            if (empty($currentViewInfow))
                return new RedirectLinkModel();
                
            switch ($currentViewInfow) {
                case HOME:
                    return new RedirectLinkModel();
                default:
                    # code...
                    break;
            }
        }
    }

    function createManagerModels() {
        return new ManagerModels();
    }
?>