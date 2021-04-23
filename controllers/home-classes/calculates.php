<?php
    class Calculates{
        public function getTotalByMonthAndCategory($date, $categoryid, $userid){
            $journeyModel = new JourneyModel();
            $total = $journeyModel->getTotalByMonthAndCategory($date, $categoryid, $userid);
            if($total == null) return 0;
            return $total;
        }
    }
?>