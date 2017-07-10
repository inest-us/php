<?php
    class User {
        private $_db;

        public function __construct($db){
            $this->_db = $db; 
        }

        public function is_logged_in(){
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                return true;
            } 
            return false;       
        }

        private function get_user_hash($username) {  
            try {
                $stmt = $this->_db->prepare('SELECT password FROM blog_members WHERE username = :username');
                $stmt->execute(array('username' => $username));
                
                $row = $stmt->fetch();
                return $row['password'];
            } catch (PDOException $e) {
                echo '<p class="error">'.$e->getMessage().'</p>';
            }
        }

        private function password_verify($password,$hashed) {
            if ($password == $hashed) {
                return 1;
            }
            return 0;
        }

        public function login($username, $password) { 
            $hashed = $this->get_user_hash($username);
            if (!$hashed) {
                return false;
            }
            if($this->password_verify($password,$hashed) == 1) {
                $_SESSION['loggedin'] = true;
                return true;
            }
            return false;       
        }
    }
?>

