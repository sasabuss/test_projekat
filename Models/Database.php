<?php

class Database
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "", "projekat_test"); 

        if ($this->db->connect_error) {
            die("Error connecting to the database: " . $this->db->connect_error);
        }
    }

    public function getConnection() {
        return $this->db;
    }
}
