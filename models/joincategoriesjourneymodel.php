<?php
    require_once 'models/journeymodel.php';
    class JoinCategoriesJourneyModel extends Model{
        private $taskId;
        private $title;
        private $hours;
        private $categoryId;
        private $date;
        private $userId;
        private $nameCategory;
        private $color;

        function __construct(){
            parent::__construct();
        }

        public function getTaskId(){
            return $this->taskId;
        }
        public function getTitle(){
            error_log('estoy obteniendo el titulo ' . $this->title);
            return $this->title;
        }
        public function getCategoryId(){
            return $this->categoryId;
        }
        public function getHours(){
            return $this->hours;
        }
        public function getDate(){
            return $this->date;
        }
        public function getUserId(){
            return $this->userId;
        }
        public function getNameCategory(){
            return $this->nameCategory;
        }
        public function getColor(){
            return $this->color;
        }


        public function setTaskId($value){
            $this->taskId = $value;
        }
        public function setTitle($value){
            $this->title = $value;
        }
        public function setCategoryId($value){
            $this->categoryId = $value;
        }
        public function setHours($value){
            $this->hours = $value;
        }
        public function setDate($value){
            $this->date = $value;
        }
        public function setUserId($value){
            $this->userId = $value;
        }
        public function setNameCategory($value){
            $this->nameCategory = $value;
        }
        public function setColor($value){
            $this->color = $value;
        }

        public function getAllByUserId($userid){
            $items = [];
            try{
                $query = $this->prepare('SELECT journey.id as task_id, title, category_id, hours, date, user_id, categories.id, name, color FROM journey INNER JOIN categories WHERE journey.category_id = categories.id AND journey.user_id = :userid ORDER BY date');
                $query->execute(['userid' => $userid]);

                while($p = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = new JoinCategoriesJourneyModel();
                    $item->from($p);
                    array_push($items, $item);
                }

                return $items;
            } catch(PDOException $e){
                error_log('JOINCATEGORIESMODEL::getAllByUserId-> PDOEXCEPTION: ' . $e);
            }
        }

        public function getAllByUserIdByMonth($month, $userid){
            $items = [];
            try{
                $month = $month;
                $year = date('Y');
                $query = $this->prepare('SELECT journey.id as task_id, title, category_id, hours, date, user_id, categories.id, name, color FROM journey INNER JOIN categories WHERE journey.category_id = categories.id AND journey.user_id = :userid AND YEAR(date) = :year AND MONTH(date) = :month ORDER BY date');
                $query->execute(['userid' => $userid, 'month' => $month, 'year' => $year]);
                while($p = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = new JoinCategoriesJourneyModel();
                    $item->from($p);
                    array_push($items, $item);
                }

                return $items;
            } catch(PDOException $e){
                error_log('JOINCATEGORIESMODEL::getAllByUserId-> PDOEXCEPTION: ' . $e);
            }
        }
        
        public function getColorAndNamesOfCategoriesUsedThisMonth($userid){
            $res = [];
            $journeyModel = new journeyModel();
            $contador = 0;
            try{
                $month = date('m');
                $year = date('Y');
                $query = $this->prepare('SELECT color as category_color, name as category_name, hours, date FROM journey INNER JOIN categories WHERE categories.id = journey.category_id AND journey.user_id = :userid AND YEAR(date) = :year AND MONTH(date) = :month');
                $query->execute([
                    'userid' => $userid,
                    'year' => $year,
                    'month' => $month
                ]);
                if($query->rowCount() <= 0) return null;
               
                while($p = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = array();
                    $item['category_color'] = $p['category_color'];
                    $item['category_name'] = $p['category_name'];
                    $item['hours'] = $p['hours'];
                    array_push($res, $item);
                }
                return $res;
            } catch(PDOException $e){
                echo $e;
                return null;
            }
        }

        public function getColorAndNamesOfCategoriesUsedLastsMonth($userid){
            try{
                $res = []; // play: 3hrs, workout: 9hrs
                $journeyModel = new journeyModel();
                $lastMonth = date('m', strtotime('-1 month'));
                $month = $lastMonth;
                $year = date('Y');
                $query = $this->prepare('SELECT color as category_color, hours,  name as category_name, date FROM journey INNER JOIN categories WHERE categories.id = journey.category_id AND journey.user_id = :userid AND YEAR(date) = :year AND MONTH(date) = :month');
                $query->execute([
                    'userid' => $userid,
                    'year' => $year,
                    'month' => $month
                ]);
                if($query->rowCount() <= 0) return 0;
                while($p = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = array();
                    $item['category_color'] = $p['category_color'];
                    $item['category_name'] = $p['category_name'];
                    $item['hours'] = $p['hours'];
                    array_push($res, $item);
                }
                    return $res;
            } catch(PDOException $e){
                echo $e;
            }
        }
        public function from($array){
            $this->taskId = $array['task_id'];
            $this->title = $array['title'];
            $this->categoryId = $array['category_id'];
            $this->hours = $array['hours'];
            $this->date = $array['date'];
            $this->userId = $array['user_id'];
            $this->nameCategory = $array['name'];
            $this->color = $array['color'];
        }

        public function toArray(){
            $array = [];
            $array['id'] = $this->taskId;
            $array['title'] = $this->title;
            $array['category_id'] = $this->categoryId;
            $array['hours'] = $this->hours;
            $array['date'] = $this->date;
            $array['id_user'] = $this->userId;
            $array['name'] = $this->nameCategory;
            $array['color'] = $this->color;

            return $array;
        }
    }
?>