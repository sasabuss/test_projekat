<?php

    class Database
    {
        private $db;

        public function __construct()
        {
            $this->db = new mysqli("localhost","root","","projekat_test");

            if ($this->db->connect_error) {
                die("Greška pri povezivanju sa bazom: " . $this->conn->connect_error);
            }
        
    
        }

        public function getConnection() {
            return $this->db;
        }

    }