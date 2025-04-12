<?php

    class Database
    {
        private $db;

        public function __construct()
        {
            $this->db = new mysqli("localhost","root","","projekat_test"); // koristim new myqsli jer tako pravi objekat i mogu da koristim connect_error

            if ($this->db->connect_error) {
                die("Greška pri povezivanju sa bazom: " . $this->db->connect_error);
            }
        
    
        }

        public function getConnection() {
            return $this->db;
        }
        
    }