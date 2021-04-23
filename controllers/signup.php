<?php
    require_once 'classes/success.php';
    require_once 'models/usermodel.php';
    class Signup extends SessionController{
        function __construct(){
            parent::__construct();
        }

        public function render(){
            $this->view->render('login/signup');
        }

        public function newUser(){
            if($this->existPost(['username', 'password', 'name'])){
                $username = $this->getPost('username');
                $password = $this->getPost('password');
                $name = $this->getPost('name');

                if($username == '' || empty($username) || $password == '' || empty($password) || $name == '' || empty($name)){
                    $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EMPTY]); 
                    return;
                }
                $user = new UserModel();

                if($user->existsUser($username)){
                    error_log('user exist already //////////////');
                    $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EXIST]); 
                    return;
                }

                $user->setUsername($username);
                $user->setPassword($password, true);
                $user->setName($name);
                $user->setRole('user');
                if($user->save()){
                    $this->redirect('', ['success'=> Success::SUCCESS_SIGNUP_NEWUSER]);
                } else{
                    $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER]); 
                    return;
                }
            } else{
                $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER]); 
                return;
            }
        }
    }
?>