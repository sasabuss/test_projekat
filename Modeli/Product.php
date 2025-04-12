<?php

    class Product 
    {

        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function addProducts($name,$description,$price,$user_id)
        {
            $name = $this->db->real_escape_string($name);
            $description = $this->db->real_escape_string($description);
            $price =$this-> db->real_escape_string($price);
            $user_id =$this-> db->real_escape_string($user_id);

            $add = ("INSERT INTO products(name,description,price,user_id)
            VALUES ('$name','$description',$price,$user_id)");

            return $this->db->query($add);
        }
    }