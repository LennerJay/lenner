<?php
    class Database{
        private $host;
        private $user;
        private $password;
        private $dbms;
        private $conn;
        private $status;
        function __construct(){
            $this->host ="localhost";
            $this->user ="root";
            $this->password ="";
            $this->dbms= "ecommerce";
            $this->status= false;
            $this->conn= $this->init();
        }
        public function getStatus(){
            return $this->status;
        }
        public function getCon(){
            return $this->conn;
        }
        public function closeConnection(){
            $this->conn = null;
        }
        private function init()
        {
            try {
                $connection = new PDO("mysql:host=$this->host;dbname=" . $this->dbms, $this->user, $this->password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->status = true;
                return $connection;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
?>