<?php

    class User
    {
        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function register($email,$password)
        {
            $email = $this->db->real_escape_string($email);
            $password = $this->db->real_escape_string($password);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $check = "SELECT * FROM users WHERE email = '$email'";
            $result = $this->db->query($check);

            if($result->num_rows > 0)
            {
                return "Email vec postoji";
            }

            $insert = "INSERT INTO users(email, password) VALUES ('$email', '$password')";
            if ($this->db->query($insert)) {
                return true;
            } else {
                return "Greška pri registraciji.";
            }
            }

            public function login($email, $password) {
                $email = $this->db->real_escape_string($email);
            
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $this->db->query($sql);
            
                if ($result && $result->num_rows > 0) {
                    $user = $result->fetch_assoc();
            
                    if (password_verify($password, $user['password'])) {
                        // pokreni sesiju i zapamti korisnika
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
            
                        $_SESSION['user'] = $user;
            
                        header("Location: dashboard.php");
                        exit;
                    } else {
                        return "Pogrešna lozinka.";
                    }
                } else {
                    return "Korisnik nije pronađen. Registrujte se.";
                    
                }
            }
        }