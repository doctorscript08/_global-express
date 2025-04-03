<?php
    class Connection {
        private static $connector = null;

        public static function connect() {
            try {
                self::$connector = new mysqli('localhost', 'root', 'doctorscript', 'global_express');

                return self::$connector;
            } catch (PDOException $e) {
                echo "ERRO: ". $e;
            }
        }
    }
?>