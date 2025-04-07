<?php
    date_default_timezone_set('Africa/Luanda');

    class Wallet {
        private $id, $balance, $last_update, $status, $user_id, $connector;

        function __construct($user_id, $connector) {
            $this->last_update = date("Y-m-d H:i:s");
            $this->user_id = $user_id;
            $this->connector = $connector;
        }

        public function create_wallet() {
            if (($this->user_id !== null) && ($this->user_id !== 0) && (!empty($this->user_id)) && (!empty($this->connector))) {
                $sql = $this->connector->query("INSERT INTO WALLETS (last_update, user_id) VALUES ('{$this->last_update}', '{$this->user_id}')");

                return $sql ? true : false;
            } else {
                return false;
            }
        }
    }
?>