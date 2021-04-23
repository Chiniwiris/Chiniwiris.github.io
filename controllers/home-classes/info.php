<?php
    class Info{
        public function getCategoryIds($userid){
            $joinModel = new JoinCategoriesJourneyModel();
            $categories = $joinModel->getAllByUserId($userid);
            $res = [];
            foreach($categories as $category){
                array_push($res, $category->getCategoryId());
            }
            $res = array_values(array_unique($res));
            return $res;
        }
        
        public function getCategoryNames($userid){
            $res = [];
            $joinModel = new JoinCategoriesJourneyModel();
            $tasks = $joinModel->getAllByUserId($userid);
            
            foreach($tasks as $category){
                array_push($res, $category->getNameCategory());
            }
            $res = array_values(array_unique($res));
            return $res;
        }

        public function getCategoryColors($userid){
            $res = [];
            $joinModel = new JoinCategoriesJourneyModel();
            $tasks = $joinModel->getAllByUserId($userid);
            
            foreach($tasks as $category){
                array_push($res, $category->getColor());
            }
            $res = array_values(array_unique($res));
            return $res;
        }

        //onlythismonth
        public function getCategoryIdsByMonth($month, $userid){
            $joinModel = new JoinCategoriesJourneyModel();
            $categories = $joinModel->getAllByUserIdByMonth($month, $userid);
            $res = [];
            foreach($categories as $category){
                array_push($res, $category->getCategoryId());
            }
            $res = array_values(array_unique($res));
            return $res;
        }
        
        public function getCategoryNamesByMonth($month, $userid){
            $res = [];
            $joinModel = new JoinCategoriesJourneyModel();
            $tasks = $joinModel->getAllByUserIdByMonth($month, $userid);
            
            foreach($tasks as $category){
                array_push($res, $category->getNameCategory());
            }
            $res = array_values(array_unique($res));
            return $res;
        }

        public function getCategoryColorsByMonth($month, $userid){
            $res = [];
            $joinModel = new JoinCategoriesJourneyModel();
            $tasks = $joinModel->getAllByUserIdByMonth($month, $userid);
            
            foreach($tasks as $category){
                array_push($res, $category->getColor());
            }
            $res = array_values(array_unique($res));
            return $res;
        }
    }
?>