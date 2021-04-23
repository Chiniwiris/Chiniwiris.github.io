<?php
    class UserRegister{
        public function getAllJourneyByUser($userid, $journey){
            $month = date('m');
            $res = $journey->getAllByUserIdByMonth($month, $userid);
            return $res;
        }
    }
?>