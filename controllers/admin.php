<?php
    require_once 'models/categoriesmodel.php';
    class Admin extends SessionController{
        function __construct(){
            parent::__construct();
        }

        public function render(){
            $stats = $this->getStatistics();
            $this->view->render('admin/index',[
                'stats' => $stats
            ]);
        }
        
        private function getStatistics(){
            $res = [];
            $journeyModel = new journeyModel();
            $journey = $journeyModel->getAll(); 
            $res['total-users'] = $this->getTotalUsers();
            $res['total-categories'] = $this->getTotalCategories();
            $res['cat-most-used'] = $this->getCategoryMostUsed($journey);
            $res['cat-less-used'] = $this->getCategoryLessUsed($journey);
            return $res; 
        }

        private function getTotalUsers(){
            $user = new UserModel();
            $total = $user->getAll();
            $total = count($total);
            return $total;
        }

        private function getTotalCategories(){
            $category = new CategoriesModel();
            $total = $category->getAll();
            $total = count($total);
            return $total;
        }

        private function getCategoryMostUsed($journey){
            $repeat = [];
            foreach($journey as $task){
                if(!array_key_exists($task->getCategoryId(), $repeat)){
                    $repeat[$task->getCategoryId()] = 0;
                } 
                $repeat[$task->getCategoryId()]++;
            }
            $categoryMostUsed = max($repeat);
            $categoryModel = new CategoriesModel();
            $categoryModel->get($categoryMostUsed);
            $category = $categoryModel->getName();
            return $category;
        }

        private function getCategoryLessUsed($journey){
            $repeat = [];
            foreach($journey as $task){
                if(!array_key_exists($task->getCategoryId(), $repeat)){
                    $repeat[$task->getCategoryId()] = 0;
                } 
                $repeat[$task->getCategoryId()]++;
            }
            $categoryLessUsed = min($repeat);
            $categoryModel = new CategoriesModel();
            $categoryModel->get($categoryLessUsed);
            $category = $categoryModel->getName();
            return $category;
        }
    }
?>