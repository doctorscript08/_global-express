<?php 
    include_once('User.php');
    include_once('Deposit.php');
    include_once('Connection.php');

    $user = new User(0, 'Kelson de Sousa', 'kelsondesousa99@gmail.com', '12345', '', '+244 921-578-427', '2007-01-08', date('Y-m-d H:i:s'));

    if ($user->deposit(Connection::connect(), 10000, 'M1', 'Aprovado')) {
        echo "deu certo!";
    } else {
        echo "deu errado!";
    }
?>