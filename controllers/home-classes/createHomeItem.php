<?php
    require_once 'models/journeyModel.php';
    
    class CreateHomeItem extends Controller{

        public function newTask($userid){
            if(!$this->existPOST(['title', 'category','hours'])){
                error_log('No existe algun metodo post para crear task');
                $this->redirect('home',['error' => Errors::ERROR_CREATEHOMEITEM_NEWTASK]); 
                return;
            }
            error_log('si existe un metodo post para crear un nuevo task');

            if($userid == null){
                $this->redirect('home',['error' => Errors::ERROR_CREATEHOMEITEM_NEWTASK]); 
                return;
            }
            $task = new JourneyModel();
            $task->setTitle($this->getPost('title'));
            $task->setCategoryId($this->getPost('category'));
            $task->setHours($this->getPost('hours'));
            $task->setDate(date('Y-m-d'));
            $task->setUserId($userid);
            if($task->save()){
                $this->redirect('home', ['success' => Success::SUCCESS_HOME_NEWTASK]); 
            } else{
                $this->redirect('home',['error' => Errors::ERROR_CREATEHOMEITEM_NEWTASK]); 
                return;
            }
        } 
    }
?>