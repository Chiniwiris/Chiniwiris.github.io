<?php
class User extends SessionController{
    private $user;
    function __construct(){
        parent::__construct();
        $this->user = $this->getUserSessionData();
    }

    public function render(){
        $this->view->render('user/index', [
            'user' => $this->user
        ]);
    }

    public function updateUsername(){
        if($this->existPOST(['username'])){
            $username = $this->getPost('username');
            if($username == '' || empty($username)){
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEUSERNAME_EMPTY]); 
                return;
            }
            $user = new UserModel();
            $user->setId($this->user->getId());
            $user->setUsername($username);
            if($user->updateUsername()){
                error_log('USER::updateUsername() se actualizó');
                $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATEUSERNAME]); 
                return;
            } else{
            error_log('USER::updateUsername() no se actualizó');
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEUSERNAME]); 
                return;
            }
        }
    }
  
    
    
    public function updatePassword(){
        if($this->existPOST(['old-password', 'new-password'])){
            $oldpass = $this->getPost('old-password');
            $newpass = $this->getPost('new-password');
            if($oldpass == '' || empty($oldpass) || $newpass == '' || empty($newpass)){
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD_EMPTY]);
                return;
            }
            $user = new UserModel();
            $user->get($this->user->getId());

            if(password_verify($oldpass, $user->getPassword())){
                $user->setPassword($newpass, true);
                if($user->updatePassword()){
                    $this->redirect('user', ['success' => Success::SUCCESS]);
                    return;
                } else{
                    $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD]);
                    return;
                }
            } else{
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATEPASSWORD_PASSWORDINCORRECT]);
                return;
            }
        }
    }

    function updatePhoto(){
        if(!isset($_FILES['photo'])){
            $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATE_PHOTO]); 
            return;
        }
        $photo = $_FILES['photo'];

        $target_dir = "img/";
        $extarr = explode('.',$photo["name"]);
        $filename = $extarr[sizeof($extarr)-2];
        $ext = $extarr[sizeof($extarr)-1];
        $hash = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $target_file = $target_dir . $hash;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
            $this->redirect('user', ['error']);
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                $this->model->updatePhoto($hash, $this->user->getId());
                $this->redirect('user', ['success' => Success::SUCCESS_USER_UPDATE_PHOTO]);
            } else {
                $this->redirect('user', ['error' => Errors::ERROR_USER_UPDATE_PHOTO_FORMAT]); 
            }
        }
        
    }

}
?>