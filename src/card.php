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
        header('Location: http://localhost/_global-express/');
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
        <link rel="stylesheet" href="./assets/css/card.css">
    <title>CARTÃO</title>
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
        </section>

        <a href="" class="btn">
            <button>
                Solicitar Cartão
            </button>
        </a>
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