<?php
    date_default_timezone_set('Africa/Luanda');

    class Wallet {
        private $id, $balance = 0, $last_update, $status, $user_id;

        function __construct($user_id) {
            $this->last_update = date("Y-m-d H:i:s");
            $this->user_id = $user_id;
        }

        public function create_wallet($connector) {
            if (($this->user_id !== null) && ($this->user_id !== 0) && (!empty($this->user_id)) && (!empty($this->connector))) {
                $sql = $connector->query("INSERT INTO WALLETS (last_update, user_id) VALUES ('{$this->last_update}', '{$this->user_id}')");

                return $sql ? true : false;
            } else {
                return false;
            }
        }

        public function load_wallet($connector, $amount_to_be_loaded) {
            if ((!empty($connector) && (!empty($this->user_id)))) {
                $amount_to_be_loaded += $this->check_balance($connector);

                $sql = $connector->query("UPDATE WALLETS SET balance = '{$amount_to_be_loaded}', last_update = '{$this->last_update}' WHERE user_id = '{$this->user_id}'");

                return $sql ? true : false;
            }
        }

        public function check_balance($connector) {
            if ((!empty($connector) && (!empty($this->user_id)))) {
                $sql = $connector->query("SELECT balance FROM WALLETS WHERE user_id = '{$this->user_id}'");

                if ($sql) {
                    $this->balance = mysqli_fetch_assoc($sql)['balance'];
                }

                return $this->balance;
            }
        }
    }
?>