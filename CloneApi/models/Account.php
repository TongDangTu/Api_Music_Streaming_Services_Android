<?php
    class Account{

        public $username;
        public $password;
        public function __construct($username,$password) {
            $this->username = $username;
            $this->password = $password;
        }
        public function getUserName() {
            return $this->username;
        }
    
        public function setUsername ($username) {
            $this->username = $username;
        }
    
        public function getPassword () {
            return $this->password;
        }
    
        public function setPassword ($password) {
            $this->password = $password;
        }
    }


?>