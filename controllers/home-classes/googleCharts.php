<?php
    require_once 'controllers/home-classes/calculates.php';
    require_once 'controllers/home-classes/info.php';
    class GoogleCharts{
        
        public function __construct(){
            $this->calculate = new Calculates();
            $this->info = new Info();    
        }

        public function getThisMonthJourneyJSONforGoogleChart($userid){
            header('Content-type: application/json');

            $res = [];
            $categoryIds = $this->info->getCategoryIds($userid); //return [list]
            $categoryNames = $this->info->getCategoryNames($userid); //return [list]
            $categoryColors = $this->info->getCategoryColors($userid); //return [list]
            array_unshift($categoryNames, 'month');
            array_unshift($categoryColors, 'category');
            $month[0] = date('Y-m');
            for($i = 0; $i < count($month); $i++){
                $item = array($month[$i]);
                for($j = 0; $j < count($categoryIds); $j++){
                    $total = $this->calculate->getTotalByMonthAndCategory($month[$i], $categoryIds[$j], $userid);
                    array_push($item, $total);
                }
                array_push($res, $item);
            }
            array_unshift($res, $categoryNames);
            array_unshift($res, $categoryColors);
            echo json_encode($res);
        }

        public function getLastMonthJourneyJSONforGoogleChart($userid){
            header('Content-type: application/json');

            $res = [];
            $categoryIds = $this->info->getCategoryIds($userid); //return [list]
            $categoryNames = $this->info->getCategoryNames($userid); //return [list]
            $categoryColors = $this->info->getCategoryColors($userid); //return [list]
            array_unshift($categoryNames, 'month');
            array_unshift($categoryColors, 'category');
            $lastMonth = date('m', strtotime('-1 month'));
            $month[0] = date('Y-' . $lastMonth);
            for($i = 0; $i < count($month); $i++){
                $item = array($month[$i]);
                for($j = 0; $j < count($categoryIds); $j++){
                    $total = $this->calculate->getTotalByMonthAndCategory($month[$i], $categoryIds[$j], $userid);
                    array_push($item, $total);
                }
                array_push($res, $item);
            }
            array_unshift($res, $categoryNames);
            array_unshift($res, $categoryColors);
            echo json_encode($res);
        }
    }
?>