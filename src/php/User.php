<?php
    require_once('Wallet.php');
    require_once('Deposit.php');
    require_once('Transfer.php');

    class User {
        private $id, $name, $email, $password, $bi, $tel_number, $birth, $registration_date, $wallet;

        public function __construct($id = null, $name = null, $email = null, $password = null, $bi = null, $tel_number = null, $birth = null, $registration_date = null) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->bi = $bi;
            $this->tel_number = $tel_number;
            $this->birth = $birth;
            $this->registration_date = $registration_date;
        }

        public function login($connector) {
            if (!(($this->email === null) || (empty($this->email))) && !(($this->password === null) || (empty($this->password)))) {
                $sql = $connector->query("SELECT email, password FROM USERS WHERE email = '{$this->email}' AND password = '{$this->password}'");

                return mysqli_num_rows($sql) > 0 ? true : false;
            } else {
                header('Location: http://localhost/_global-express/src/');
                exit();
            }
        }

        public function register($connector) {
            if (!(($this->name === null) || (empty($this->name))) && !(($this->email === null) || (empty($this->email))) && !(($this->password === null) || (empty($this->password))) && !(($this->tel_number === null) || (empty($this->tel_number))) && !(($connector === null) || (empty($connector)))) {
                $sql = $connector->query("INSERT INTO USERS (name, email, tel_number, birth, password, registration_date) VALUES ('{$this->name}', '{$this->email}', '{$this->tel_number}', '{$this->birth}', '{$this->password}', '{$this->registration_date}')");

                if ($sql) {
                    $this->wallet = new Wallet($this->search_id_with_email_password($this->email, $this->password, $connector));

                    return $this->wallet->create_wallet($connector) ? true : false;
                } else {
                    return false;
                }

                return $sql ? true : false;
            } else {
                header('Location: http://localhost/_global-express/src/register.php');
                exit();
            }
        }

        public function deposit($connector, $amount_to_be_loaded, $method, $status) {
            if (!empty($connector) && (!empty($this->email) && (!empty($this->password)))) {
                $this->wallet = new Wallet($this->search_id_with_email_password($this->email, $this->password, $connector));

                if ($this->wallet->load_wallet($connector, $amount_to_be_loaded)) {
                    $deposit = new Deposit($amount_to_be_loaded, $method, $status, $this->search_id_with_email_password($this->email, $this->password, $connector));

                    return $deposit->register_deposit($connector) ? true : false;
                } else {
                    return false;
                }
            }
        }

        public function transfer($connector, $amount_to_transfer, $receiving_number, $status) {
            if ((!empty($connector)) && (!empty($amount_to_transfer) && (!empty($this->email)) && (!empty($this->password)) && (!empty($receiving_number)))) {
                $this->wallet = new Wallet($this->search_id_with_email_password($this->email, $this->password, $connector));

                if ($this->wallet->check_balance($connector) >= $amount_to_transfer) {
                    if ($this->wallet->transfer($connector, $amount_to_transfer)) {
                        $receing_wallet = new Wallet($this->search_id_with_tel_number($receiving_number, $connector));

                        if ($receing_wallet->add_transfer_value($connector, $amount_to_transfer)) {
                            $transfer = new Transfer($amount_to_transfer, $status, $this->search_id_with_email_password($this->email, $this->password, $connector), $this->search_id_with_tel_number($receiving_number, $connector));

                            return $transfer->register_transfer($connector) ? true : false;
                        }
                    }
                }
            }
        }

        public function consult_deposits($connector) {
            if (!empty($connector) && (!empty($this->email)) && (!empty($this->password))) {
                $sql = $connector->query("SELECT id_deposit, value, method, status, deposit_date FROM DEPOSITS WHERE user_id = '{$this->search_id_with_email_password($this->email, $this->password, $connector)}'");

                $deposit_data = [];
                $i = 0;

                while ($deposits = mysqli_fetch_assoc($sql)) {
                    $deposit_data[$i] = $deposits;
                    $i++;
                }

                $i = 0;
                return $deposit_data;
            }
        }

        public function consult_transfers($connector) {
            if (!empty($connector) && (!empty($this->email)) && (!empty($this->password))) {
                $sql = $connector->query("SELECT id_transfer, amount_to_transfer, status, transfer_date, s.name as 'sender', r.name as 'receiving'
                FROM TRANSFERS
                join users as s on s.id_user = sender_user
                join users as r on r.id_user = receiving_user 
                WHERE sender_user = '{$this->search_id_with_email_password($this->email, $this->password, $connector)}' OR receiving_user = '{$this->search_id_with_email_password($this->email, $this->password, $connector)}' 
                order by id_transfer");

                $transfer_data = [];
                $i = 0;

                while ($transfers = mysqli_fetch_assoc($sql)) {
                    $transfer_data[$i] = $transfers;
                    $i++;
                }

                $i = 0;
                return $transfer_data;
            }
        }

        private function search_id_with_email_password($email, $password, $connector) {
            $sql = $connector->query("SELECT id_user FROM USERS WHERE email = '{$email}' and password = '{$password}'");

            return mysqli_fetch_assoc($sql)['id_user'];
        }

        private function search_id_with_tel_number($tel_number, $connector) {
            $sql = $connector->query("SELECT id_user FROM USERS WHERE tel_number = '{$tel_number}'");

            return mysqli_fetch_assoc($sql)['id_user'];
        }

        public function search_name($email, $password, $connector) {
            $sql = $connector->query("SELECT name FROM USERS WHERE email = '{$email}' and password = '{$password}'");

            return mysqli_fetch_assoc($sql)['name'];
        }
    }
?>