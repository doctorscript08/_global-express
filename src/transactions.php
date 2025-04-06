<?php
    session_start();

    if (isset($_SESSION['name'], $_SESSION['email'], $_SESSION['password'])) {

    } elseif (isset($_SESSION['email'], $_SESSION['password'])) {

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