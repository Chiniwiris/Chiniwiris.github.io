<?php
    class journeyModel extends Model implements IModel{
        private $id;
        private $title;
        private $hours;
        private $categoryid;
        private $date;
        private $userid;
    
        public function setId($id){ $this->id = $id; }
        public function setTitle($title){ $this->title = $title; }
        public function setHours($hours){ $this->hours = $hours; }
        public function setCategoryId($categoryid){ $this->categoryid = $categoryid; }
        public function setDate($date){ $this->date = $date; }
        public function setUserId($userid){ $this->userid = $userid; }
    
        public function getId(){ return $this->id;}
        public function getTitle(){ return $this->title; }
        public function getHours(){ return $this->hours; }
        public function getCategoryId(){ return $this->categoryid; }
        public function getDate(){ return $this->date; }
        public function getUserId(){ return $this->userid; }
    
    
        public function __construct(){
            parent::__construct();
        }

        public function getMostRecentTask($userid){
            try{
                $query = $this->prepare('SELECT title, hours FROM journey WHERE user_id = :userid ORDER BY date DESC LIMIT 0, 1');
                $query->execute(['userid' => $userid]);
                if($query->rowCount() == 0) return null;
                $item = $query->fetch(PDO::FETCH_ASSOC);
                return $item;
            } catch(PDOException $e){
                echo $e;
                return null;
            }
        }

        public function getTotalHoursByCategoryThisMonth($categoryid, $userid){
            try{
                $total = 0;
                $year = date('Y');
                $month = date('m');
                $query = $this->prepare('SELECT SUM(hours) AS total FROM journey WHERE user_id = :userid AND category_id = :categoryid AND YEAR(date) = :year AND MONTH(date) = :month');

                $query->execute([
                'userid' => $userid,
                'categoryid' => $categoryid,
                'year' => $year,
                'month' => $month]);
                if($query->rowCount() > 0) return $query->fetch(PDO::FETCH_ASSOC)['total'];

                return 0;
            } catch(PDOException $e){
                error_log('JOURNEYMODEL::getTotalHoursByCategoryThisMonth-> PDOEXCEPTION: ' . $e);
                return null;
            }
        }

        public function getNumberOfTaskByCategoryThisMonth($categoryid, $userid){
            try{
                $total = 0;
                $year = date('Y');
                $month = date('M');
                $query = $this->prepare('SELECT COUNT(id) AS total FROM journey WHERE category_id = :categoryid AND user_id = :userid AND YEAR(date) = :year AND MONTH(date) = :month');
                $query->execute([
                    'userid' => $userid,
                    'categoryid' => $categoryid,
                    'year' => $year,
                    'month' => $month
                ]);
                $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
                if($total == null) return 0;
                return $total;
            } catch(PDOException $e){
                error_log('JOURNEYMODEL::getTotalHoursByCategoryThisMonth-> PDOEXCEPTION: ' . $e);
                return null;
            }
        }
    
        function getTotalByMonthAndCategory($date, $categoryid, $userid){
            try {
                $total = 0;
                $year = substr($date, 0, 4);
                $month = substr($date, 5, 7);
                $query = $this->db->connect()->prepare('SELECT SUM(hours) AS total from journey WHERE category_id = :val AND user_id = :userid AND YEAR(date) = :year AND MONTH(date) = :month');

                $query->execute(['val' => $categoryid, 'userid' => $userid, 'year' => $year, 'month' => $month]);

                if ($query->rowCount() > 0) {
                    $total = $query->fetch(PDO::FETCH_ASSOC)['total'];
                } else {
                    return 0;
                }

                return $total;
            } catch (PDOException $e) {
                echo $e;
            }
        }

        
        public function save(){
            try{
                $query = $this->prepare('INSERT INTO journey (title, hours, category_id, date, user_id) VALUES(:title, :hours, :category, :d, :user)');
                $query->execute([
                    'title' => $this->title, 
                    'hours' => $this->hours, 
                    'category' => $this->categoryid, 
                    'user' => $this->userid, 
                    'd' => $this->date
                ]);
                if($query->rowCount()) return true;
    
                return false;
            }catch(PDOException $e){
                error_log($e);
                return false;
            }
        }

        public function getAll(){
            $items = [];
    
            try{
                $query = $this->query('SELECT * FROM journey');
    
                while($p = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = new journeyModel();
                    $item->from($p); 
                    
                    array_push($items, $item);
                }
    
                return $items;
    
            }catch(PDOException $e){
                echo $e;
            }
        }

        public function get($id){
            try{
                $query = $this->prepare('SELECT * FROM journey WHERE id = :id');
                $query->execute([ 'id' => $id]);
                $user = $query->fetch(PDO::FETCH_ASSOC);
    
                $this->from($user);
    
                return $this;
            }catch(PDOException $e){
                return false;
            }
        }

        public function delete($id){
            try{
                $query = $this->prepare('DELETE FROM journey WHERE id = :id');
                $query->execute([ 'id' => $id]);
                return true;
            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        public function update(){
            try{
                $query = $this->prepare('UPDATE journey SET title = :title, hours = :hours, category_id = :category, date = :d, id_user = :user WHERE id = :id');
                $query->execute([
                    'title' => $this->title, 
                    'hours' => $this->hours, 
                    'category' => $this->categoryid, 
                    'user' => $this->userid, 
                    'd' => $this->date
                ]);
                return true;
            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        public function from($array){
            $this->id = $array['id'];
            $this->title = $array['title'];
            $this->hours = $array['hours'];
            $this->categoryid = $array['category_id'];
            $this->date = $array['date'];
            $this->userid = $array['id_user'];
        }
    }
?>