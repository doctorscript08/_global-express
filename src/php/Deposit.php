<?php 
    date_default_timezone_set('Africa/Luanda');

    class Deposit {
        private $id, $value, $method, $status, $deposit_date, $user_id;

        public function __construct($value = null, $method = null, $status = null, $user_id = null) {
            $this->value = $value;
            $this->method = $method;
            $this->status = $status;
            $this->deposit_date = date('Y-m-d H:i:s');
            $this->user_id = $user_id;
        }

        public function register_deposit($connector) {
            if ((!empty($connector)) && (!empty($this->user_id))) {
                $sql = $connector->query("INSERT INTO DEPOSITS (value, method, status, uploud_date, user_id) VALUES ('{$this->value}', '{$this->method}', '{$this->status}', '{$this->deposit_date}', '{$this->user_id}')");

                return $sql ? true : false;
            }
        }
    }
?>