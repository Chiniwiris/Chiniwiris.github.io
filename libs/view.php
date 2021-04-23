<?php
    class View{
        private $d;
        function __construct(){
            
        }

        public function render($name, $data = []){
            $this->d = $data;
            $this->handleMessages();
            require 'views/' . $name . '.php';
        }

        private function handleMessages(){
            if(isset($_GET['success']) && isset($_GET['error'])){
            }else if(isset($_GET['success'])){
                
                $this->handleSuccess();
            }else if(isset($_GET['error'])){
                $this->handleError();
            }
        }

        private function handleSuccess(){
            if(isset($_GET['success'])){
                $hash = $_GET['success'];
                $success = new Success();

                if($success->existsKey($hash)){
                    $this->d['success'] = $success->get($hash); 
                } else{
                    $this->d['success'] = null;
                }
            }
        }

        private function handleError(){
            if(isset($_GET['error'])){
                $hash = $_GET['error'];
                $errors = new Errors();
    
                if($errors->existsKey($hash)){
                    error_log('View::handleError() existsKey =>' . $errors->get($hash));
                    $this->d['error'] = $errors->get($hash);
                }else{
                    $this->d['error'] = NULL;
                }
            }
        }
        
        public function showMessages(){
            $this->showError();
            $this->showSuccess();
        }
    
        public function showError(){
            if(array_key_exists('error', $this->d)){
                echo '<div style="background-color: red" class="error">'.$this->d['error'].'</div>';
            }
        }
    
        public function showSuccess(){
            if(array_key_exists('success', $this->d)){
                echo '<div style="background-color: green" class="success">'.$this->d['success'].'</div>';
            }
        }
    }
?>