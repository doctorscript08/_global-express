<?php
    session_start();
    require_once('./php/Connection.php');

    if (isset($_SESSION['name'], $_SESSION['email'], $_SESSION['password'])) {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
    } elseif (isset($_SESSION['email'], $_SESSION['password'])) {
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
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
    <link rel="stylesheet" href="./assets/css/operations.css">
    <link rel="stylesheet" href="./assets/css/form.css">
    <title>CARREGAMENTOS</title>
</head>

<body>
    <header class="head">
        <div class="back">
            <a onclick="javacript:location.href='home.php'">
                <span class="material-icons">
                    arrow_back
                </span>
            </a>
        </div>
    </header>
    <main class="body">
        <h1>Carregamentos</h1>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="pay_value">Valor a carregar</label>
            <input type="text" name="pay_value" id="pay_value" class="input-user" require placeholder="ex: 10.000,00">

            <label for="payment_method">Método de pagamento</label>
            <select name="payment_method" id="payment_method" class="input-user">
                <option>Transferência bancária</option>
                <option>Cartão de crédito</option>
                <option>Cartão de dédito</option>
            </select>

            <input type="submit" value="Continuar" onclick="javascript:location.href=''" class="btn">

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $connector = Connection::connect();
            }
            ?>
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $('#pay_value').mask("#.##0,00", {reverse: true});
    </script>
</body>

</html>