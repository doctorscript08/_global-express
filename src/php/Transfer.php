<?php
    date_default_timezone_set('Africa/Luanda');
    
    class Transfer {
        private $id, $value, $status, $transfer_date, $sender_user, $receiving_user;

        public function __construct($value = null, $status = null, $sender_user = null, $receiving_user = null) {
            $this->value = $value;
            $this->status = $status;
            $this->transfer_date = date('Y-m-d H:i:s');
            $this->sender_user = $sender_user;
            $this->receiving_user = $receiving_user;
        }

        public function register_transfer($connector) {
            if (!empty($connector) && (!empty($this->sender_user)) && (!empty($this->receiving_user))) {
                $sql = $connector->query("INSERT INTO TRANSFERS (amount_to_transfer, status, transfer_date, sender_user, receiving_user) VALUES ('{$this->value}', '{$this->status}', '{$this->transfer_date}', '{$this->sender_user}', '{$this->receiving_user}')");

                return $sql ? true : false;
            }
        }
    }
?>