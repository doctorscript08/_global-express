<?php
    session_start();
    require_once('./php/Connection.php');
    require_once('./php/User.php');
    
    $user = new User(0, '', $_SESSION['email'], $_SESSION['password']);

    if (isset($_SESSION['name'], $_SESSION['email'], $_SESSION['password'])) {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
    } elseif (isset($_SESSION['email'], $_SESSION['password'])) {
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $name = $user->search_name($email, $password, Connection::connect());
    } else {
        header('Location: http://localhost/_global-express/src/');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-AO">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/transactions.css">
    <title>TRANSAÇÕES</title>
</head>

<body>
    <header class="head">
        <div class="profile">

        </div>
    </header>
    <main class="body">
        <?php include('./profile.php');?>
        <h1>Histórico de transações</h1>

        <h2>Carregamentos</h2>
        <table>
            <thead>
                <th>ID</th>
                <th>VALOR</th>
                <th>MÉTODO</th>
                <th>STATUS</th>
                <th>DATA</th>
            </thead>
            <tbody>
                <?php
                    $deposits_array = $user->consult_deposits(Connection::connect());

                    for ($i = 0; $i < count($deposits_array); $i++) {
                        echo "
                            <tr>
                                <td>{$deposits_array[$i]['id_deposit']}</td>
                                <td>{$deposits_array[$i]['value']}</td>
                                <td>{$deposits_array[$i]['method']}</td>
                                <td>{$deposits_array[$i]['status']}</td>
                                <td>{$deposits_array[$i]['deposit_date']}</td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
        <h2>Transferências</h2>
        <table>
            <thead>
                <th>ID</th>
                <th>VALOR</th>
                <th>STATUS</th>
                <th>DATA</th>
                <th>REMETENTE</th>
                <th>RECEPTOR</th>
            </thead>
            <tbody>
                <?php 
                    $transfers_array = $user->consult_transfers(Connection::connect());

                    for ($i = 0; $i < count($transfers_array); $i++) {
                        echo "
                            <tr>
                                <td>{$transfers_array[$i]['id_transfer']}</td>
                                <td>{$transfers_array[$i]['amount_to_transfer']}</td>
                                <td>{$transfers_array[$i]['status']}</td>
                                <td>{$transfers_array[$i]['transfer_date']}</td>
                                <td>{$transfers_array[$i]['sender']}</td>
                                <td>{$transfers_array[$i]['receiving']}</td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </main>
    <footer class="rodape">
        <a href="home.php">
            <span class="material-icons">
                home
            </span>
        </a>
        <a href="card.php">
            <span class="material-icons">
                credit_card
            </span>
        </a>
        <a href="">
            <span class="material-icons">
                swap_vert
            </span>
        </a>
    </footer>

    <script src="./assets/js/script.js"></script>
</body>

</html>