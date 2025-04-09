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
    <link rel="stylesheet" href="./assets//css/index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
    <title>HOME</title>
</head>

<body>
    <header class="head">
        <div class="profile">

        </div>
    </header>
    <main class="body">
        <?php include('./profile.php');?>
        
        <section class="card">
            <span class="global-title">Global Express</span>
            <div><span class="card-number">0000 0000 0000 0000</span></div>
        </section>
        <section class="view-balance">
            <span class="balance">0,00 AOA</span>
            <span class="material-icons show-hide">
                visibility
            </span>
        </section>
        <section class="actions">
            <a href="transfer.php" class="btn">
                <button>Enviar</button>
            </a>
            <a href="deposits.php" class="btn">
                <button>Carregar</button>
            </a>
        </section>
        <sections class="hitory-transactions">
            <span class="material-icons">
                history
            </span>
            <p>
                <span>Ainda sem transações</span>
            </p>
        </sections>
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
        <a href="transactions.php">
            <span class="material-icons">
                swap_vert
            </span>
        </a>
    </footer>

    <script src="./assets/js/script.js"></script>
</body>

</html>