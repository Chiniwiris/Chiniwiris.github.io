<?php
    class Login extends SessionController{
        function __construct(){
            parent::__construct();
        }

        public function render(){
            $this->view->render('login/login');
        }

        public function authenticate(){
            if($this->existPOST(['username', 'password'])){
                $username = $this->getPost('username');
                $password = $this->getPost('password');

                if($username == '' || empty($username || $password == '' || empty($password))){
                    $this->redirect('', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
                    return;
                }
                $user = $this->model->login($username, $password);
                if($user != null){
                    $this->initialize($user);
                } else{
                    $this->redirect('', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE_PASSWORDINCORRECT]);
                }
            } else{
                $this->redirect('', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE]);
            }
        }
    }
?>