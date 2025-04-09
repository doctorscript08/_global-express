<?php 
    include_once('User.php');
    include_once('Deposit.php');
    include_once('Connection.php');

    $user_sender = new User(0, 'Kelson de Sousa', 'kelsondesousa99@gmail.com', '12345', '', '+244 921-578-427', '2007-01-08', date('Y-m-d H:i:s'));
    $user_receiving = new User(0, 'Késia de Sousa', 'kesiasousa@gmail.com', '54321', '', '+244 927-242-805', '2003-03-02', date('Y-m-d H:i:s'));

    if ($user_sender->transfer(Connection::connect(), 10000, '+244 927-242-805', 'Concluída')) {
        echo "deu certo!";
    } else {
        echo "deu errado!";
    }
?>