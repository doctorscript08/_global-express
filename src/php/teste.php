<?php 
    include_once('User.php');
    include_once('Wallet.php');
    include_once('Connection.php');

    $user = new User(0, 'Kelson', 'kel@gmail.com', '543', '', '+244 921-457-577', '2007-02-08', date('Y-m-d H:i:s'), Connection::connect());

    if ($user->register()) {
        echo "<script>
            alert('Inserido com sucesso')
        </script>";
    } else {
        echo "<script>
            alert('ERRO')
        </script>";
    }
?>