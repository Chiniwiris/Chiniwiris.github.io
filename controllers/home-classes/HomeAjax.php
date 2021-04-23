<?php
    require_once 'controllers/home-classes/info.php';
    require_once 'controllers/home-classes/calculates.php';
    class HomeAjax{
        public function __construct(){
            $this->calculate = new Calculates();
            $this->info = new Info();    
        }

        public function getThisMonthUserJourney($userid){
            $res = [];
            $month = date('m');
            $date = date('Y-m');
            $categoryIds = $this->info->getCategoryIdsByMonth($month, $userid); //return [list]
            $categoryNames = $this->info->getCategoryNamesByMonth($month, $userid); //return [list]
            $categoryColors = $this->info->getCategoryColorsByMonth($month, $userid); //return [list]
            
            for($i = 0; $i < count($categoryIds); $i++){
                $item['name'] = $categoryNames[$i];
                $item['color'] = $categoryColors[$i];
                $item['hours'] = $this->calculate->getTotalByMonthAndCategory($date, $categoryIds[$i], $userid);
                array_push($res, $item); 
            }
            echo json_encode($res);
        }

        public function getLastMonthUserJourney($userid){
            $res = [];
            $month = date('m', strtotime('-1 month'));
            $date = date('Y-' . $month);
            $categoryIds = $this->info->getCategoryIdsByMonth($month, $userid); //return [list]
            $categoryNames = $this->info->getCategoryNamesByMonth($month, $userid); //return [list]
            $categoryColors = $this->info->getCategoryColorsByMonth($month, $userid); //return [list]
            
            for($i = 0; $i < count($categoryIds); $i++){
                $item['name'] = $categoryNames[$i];
                $item['color'] = $categoryColors[$i];
                $item['hours'] = $this->calculate->getTotalByMonthAndCategory($date, $categoryIds[$i], $userid);
                array_push($res, $item); 
            }
            echo json_encode($res);
        }
    }
?>