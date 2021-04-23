<?php
    require_once 'models/joincategoriesjourneymodel.php';
    require_once 'controllers/register-classes/userRegister.php';
    class Register extends SessionController{
        private $joinModel;
        private $user;
        function __construct(){
            parent::__construct();
            $this->user = $this->getUserSessionData();
            $this->joinModel = new JoinCategoriesJourneyModel();
        }

        public function render(){            
            $this->view->render('register/index', [
                'user' => $this->user,
                'journey' => $this->getAllByUserId($this->user->getId(), $this->joinModel)
            ]);
        }

        private function getAllByUserId($userid, $joinModel){
            $userRegister = new UserRegister();
            return $userRegister->getAllJourneyByUser($userid, $joinModel);
        }

        public function delete($params){
            $id = $params[0];
            error_log('Refister::delete() ' . $id);
            $journeyModel = new JourneyModel();
            if($journeyModel->delete($id)) echo 'deleted';
        }
    }
?>