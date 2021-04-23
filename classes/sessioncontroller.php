<?php
    require_once 'classes/session.php';
    require_once 'models/usermodel.php';
    class SessionController extends Controller{
        private $userSession;
        private $username;
        private $userid;
        private $session;
        private $sites;
        private $user;
        private $defaultSites;

        public function __construct(){
            parent::__construct();
            $this->init();
        }

        public function init(){
            $this->session = new Session();
            $json = $this->getJSONFileConfig();
            $this->sites = $json['sites'];
            $this->defaultSites = $json['default-sites'];
            $this->validateSession();
        } 

        private function validateSession(){
            error_log('SESSIONCONTROLLER: validateSession() ');
            if($this->existSession()){
                $role = $this->getUserSessionData()->getRole();
                error_log('SESSIONCONTROLLER::validateSession(): session active.');
                if($this->isPublic()){
                    error_log('SESSIONCONTROLLER::validateSession(): this page is public, so we a redirectingSiteByRole.');
                    $this->redirectSiteByRole($role);
                } else{
                    error_log('SESSIONCONTROLLER::validateSession(): this page is not public.');
                    if($this->isAuthorized($role)){
                        //let in
                    error_log('SESSIONCONTROLLER::validateSession(): you are authorized to in.');
                    } else{
                    error_log('SESSIONCONTROLLER::validateSession(): you are authorized to in, so you are redirecting to your default site.');
                        $this->redirectSiteByRole($role);
                    }
                }
            } else{
                error_log('SESSIONCONTROLLER::validateSession(): no session active.');
                if($this->isPublic()){
                    //let in
                    error_log('SESSIONCONTROLLER::validateSession(): this page is public, so you can in.');
                } else{
                    error_log('SESSIONCONTROLLER::validateSession(): this page is not public, so we a redirectigSiteByRole.');
                    header('Location: ' . constant('URL') . '');
                }
            }
        }

        private function isAuthorized($role){
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/", "", $currentURL);

            for($i = 0; $i < sizeof($this->sites); $i++){
                if($this->sites[$i]['site'] == $currentURL && $this->sites[$i]['role'] == $role) return true;
            }
            return false;
        }

        private function isPublic(){
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/", "", $currentURL);
            
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($this->sites[$i]['site'] == $currentURL && $this->sites[$i]['access'] == 'public'){
                    return true;
                }
            }
        }

        private function redirectSiteByRole($role){
            $url = '';
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($this->sites[$i]['role'] == $role){
                    $url = $this->sites[$i]['site'];
                    break;
                }
            }
            header('Location: ' . $url);
        }

        private function getCurrentPage(){
            $actualLink = trim("$_SERVER[REQUEST_URI]");
            $url = explode('/', $actualLink);
            return $url[2];
        }

        public function getJSONFileConfig(){
            $json = file_get_contents('config/access.json');
            $res = json_decode($json, true);
            return $res;
        }

        private function existSession(){
            if(!$this->session->exists()) return false;
            $userid = $this->session->getCurrentUser();
            if($userid) return true;
            return false;
        }

        public function getUserSessionData(){
            $id = $this->session->getCurrentUser();
            $this->user = new UserModel();
            $this->user->get($id);
            return $this->user;
        }

        public function initialize($user){
            $this->session->setCurrentUser($user->getId());
            $this->authorizeAccess($user->getRole());
        }

        public function authorizeAccess($role){
            switch($role){
                case 'user':
                    $this->redirect($this->defaultSites['user'], []);
                    error_log('SESSIONCONTROLLER::authorizeAccess(): redirected to default for users');
                    break;
                case 'admin':
                    $this->redirect($this->defaultSites['admin'], []);
                    error_log('SESSIONCONTROLLER::authorizeAccess(): redirected to default for admins');
                    break;
            }
        }

        public function logout(){
            $this->session->closeSession();
        }
    }
?>