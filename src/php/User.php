<?php
    class User {
        private $id, $name, $email, $password, $bi, $tel_number, $birth, $registration_date, $connector;

        public function __construct($id = null, $name = null, $email = null, $password = null, $bi = null, $tel_number = null, $birth = null, $registration_date = null, $connector = null) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->bi = $bi;
            $this->tel_number = $tel_number;
            $this->birth = $birth;
            $this->registration_date = $registration_date;
            $this->connector = $connector;
        }

        public function login() {
            if (!(($this->email === null) || (empty($this->email))) && !(($this->password === null) || (empty($this->password)))) {
                $sql = $this->connector->query("SELECT email, password FROM USERS WHERE email = '{$this->email}' AND password = '{$this->password}'");

                return mysqli_num_rows($sql) > 0 ? true : false;
            } else {
                header('Location: http://localhost/_global-express/src/');
                exit();
            }
        }

        public function register() {
            if (!(($this->name === null) || (empty($this->name))) && !(($this->email === null) || (empty($this->email))) && !(($this->password === null) || (empty($this->password))) && !(($this->tel_number === null) || (empty($this->tel_number))) && !(($this->connector === null) || (empty($this->connector)))) {
                $sql = $this->connector->query("INSERT INTO USERS (name, email, tel_number, birth, password, registration_date) VALUES ('{$this->name}', '{$this->email}', '{$this->tel_number}', '{$this->birth}', '{$this->password}', '{$this->registration_date}')");

                return $sql ? true : false;
            } else {
                header('Location: http://localhost/_global-express/src/register.php');
                exit();
            }
        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getBi() {
            return $this->bi;
        }

        public function getTel_number() {
            return $this->tel_number;
        }

        public function getBirth() {
            return $this->birth;
        }

        public function getRegistration_date() {
            return $this->registration_date;
        }
    }
?>