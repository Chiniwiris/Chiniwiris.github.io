<?php
    class UserModel extends Model implements IModel{
        private $id;
        private $username;
        private $password;
        private $role;
        private $hours;
        private $photo;
        private $name;

        public function __construct(){
            parent::__construct();
    
            $this->username = '';
            $this->password = '';
            $this->role = '';
            $this->hours = 0;
            $this->photo = '';
            $this->name = '';
        }
    
        public function updateUsername(){
            try{
                $query = $this->prepare('UPDATE users SET username = :username WHERE id = :id');
                $query->execute([
                    'username' => $this->username,
                    'id' => $this->id
                ]);
                if($query->rowCount() > 0) return true;
                return false;
            } catch(PDOException $e){
                error_log('USERMODEL::updateUsername() ' . $e);
                return false;
            }
        }

        public function updateName(){
            try{
                $query = $this->prepare('UPDATE users SET name = :name WHERE id = :id');
                $query->execute([
                    'name' => $this->name,
                    'id' => $this->id
                ]);
                if($query->rowCount() > 0) return true;
                return false;
            } catch(PDOException $e){
                error_log('USERMODEL::updatename() ' . $e);
                return false;
            }
        }

        public function updatePassword(){
            try{
                $query = $this->prepare('UPDATE users SET password = :password WHERE id = :id');
                $query->execute([
                    'password' => $this->password,
                    'id' => $this->id
                ]);
                if($query->rowCount() > 0) return true;
                return false;
            } catch(PDOException $e){
                error_log('USERMODEL::updatepassword() ' . $e);
                return false;
            }
        }

        function updatePhoto($name, $iduser){
            try{
                $query = $this->db->connect()->prepare('UPDATE users SET photo = :val WHERE id = :id');
                $query->execute(['val' => $name, 'id' => $iduser]);
    
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function existsUser($username){
            try{
                $query = $this->prepare('SELECT username FROM users WHERE username = :username');
                $query->execute(['username' => $username]);
                if($query->rowCount() > 0) return true;
                return false;
            }catch(PDOException $e){
                error_log('USERMODEL::save-> PDOEXCEPTION: ' . $e);
                return false;
            }
        }

        public function save(){
            try{
                $query = $this->prepare('INSERT INTO users(username, password, role, hours, photo, name) VALUES (:username, :password, :role, :hours, :photo, :name)');
                $query->execute([
                    'username' => $this->username,
                    'password' => $this->password,
                    'role' => $this->role,
                    'hours' => $this->hours,
                    'photo' => $this->photo,
                    'name' => $this->name
                ]);
                if($query->rowCount() > 0) return true; 
                return false;
            }catch(PDOException $e){
                error_log('USERMODEL::save-> PDOEXCEPTION: ' . $e);
                return false;
            }
        }
        public function getAll(){
            $users = [];
            try{
                $query = $this->query('SELECT * FROM users');
                while($p = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = new UserModel();
                    $item = new UserModel();
                    $item->setId($p['id']);
                    $item->setUsername($p['username']);
                    $item->setPassword($p['password'], false);
                    $item->setHours($p['hours']);
                    $item->setRole($p['role']);
                    $item->setPhoto($p['photo']);
                    $item->setName($p['name']);     
                    array_push($items, $item);
                }
                return $items;
            }catch(PDOException $e){
                error_log('USERMODEL::getAll-> PDOEXCEPTION: ' . $e);
                return false;
            }
        }
        public function get($id){
            try{
                $query = $this->prepare('SELECT * FROM users WHERE id = :id');
                $query->execute([ 'id' => $id]);
                $user = $query->fetch(PDO::FETCH_ASSOC);

                $this->id = $user['id'];
                $this->username = $user['username'];
                $this->password = $user['password'];
                $this->role = $user['role'];
                $this->hours = $user['hours'];
                $this->photo = $user['photo'];
                $this->name = $user['name'];

                return $this;
            }catch(PDOException $e){
                error_log('USERMODEL::get-> PDOEXCEPTION: ' . $e);
                return false;
            }
        }
        public function delete($id){
            try{
                $query = $this->prepare('DELETE FROM users WHERE id = :id');
                $query->execute([ 'id' => $id]);
                return true;
            }catch(PDOException $e){
                error_log('USERMODEL::delete-> PDOEXCEPTION: ' . $e);
                return false;
            }
        }
        public function update(){
            try{
                $query = $this->prepare('UPDATE users SET username = :username, password = :password, hours = :hours, photo = :photo, name = :name WHERE id = :id');
                $query->execute([
                'id'        => $this->id,
                'username' => $this->username, 
                'password' => $this->password,
                'hours' => $this->hours,
                'photo' => $this->photo,
                'name' => $this->name
                ]);
            return true;
            }catch(PDOException $e){
                error_log('USERMODEL::update-> PDOEXCEPTION: ' . $e);
                return false;
            }
        }
        public function from($array){
            $this->id = $array['id'];
            $this->username = $array['username'];
            $this->password = $array['password'];
            $this->role = $array['role'];
            $this->hours = $array['hours'];
            $this->photo = $array['photo'];
            $this->name = $array['name'];
        }
    
        private function getHashedPassword($password){
            return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
        }
    
        //FIXME: validar si se requiere el parametro de hash
        public function setPassword($password, $hash = true){ 
            if($hash){
                $this->password = $this->getHashedPassword($password);
            }else{
                $this->password = $password;
            }
        }
        public function setUsername($username){ $this->username = $username;}
        public function setId($id){             $this->id = $id;}
        public function setHours($hours){         $this->hours = $hours;}
        public function setRole($role){     $this->role = $role;}
        public function setPhoto($photo){       $this->photo = $photo;}
        public function setName($name){         $this->name = $name;}
    
        public function getId(){        return $this->id;}
        public function getUsername(){  return $this->username;}
        public function getPassword(){  return $this->password;}
        public function getHours(){      return $this->hours;}
        public function getRole(){    return $this->role;}
        public function getPhoto(){     return $this->photo;}
        public function getName(){      return $this->name;}
    }
?>