<?php
    session_start();
    require_once('./php/Connection.php');
    require_once('./php/User.php');

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
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
            <label for="pay_value">Valor a carregar</label>
            <input type="text" name="pay_value" id="pay_value" class="input-user" require placeholder="ex: 10.000,00">

            <label for="payment_method">Método de pagamento</label>
            <select name="payment_method" id="payment_method" class="input-user">
                <option value="M1">Cartão de crédito</option>
                <option value="M2">Cartão de dédito</option>
            </select>

            <label for="card_number">Número do cartão</label>
            <input type="text" name="card_number" id="card_number" class="input-user" require placeholder="0000 0000 0000 0000">

            <label for="validation_date">Data de validade</label>
            <input type="text" name="validation_date" id="validation_date" class="input-user" placeholder="MM-AAAA" required>
            
            <label for="cvv">CVV</label>
            <input type="text" name="cvv" id="cvv" class="input-user" placeholder="000" required>

            <input type="submit" value="Carregar" class="btn">
        </form>
    </main>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User(0, '', $email, $password);
            $pay_value = formatCurrencyToFloat($_POST['pay_value']);

            if ($user->deposit(Connection::connect(), $pay_value, $_POST['payment_method'], 'Aprovado')) {
                header('Location: http://localhost/_global-express/src/home.php');
                exit();
            } else {
                echo "
                    <script>
                        alert('Falha ao efectuar carregamento!')
                    </script>
                ";
            }
        }

        function formatCurrencyToFloat($value) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);

            return (float) $value;
        }
    ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $('#pay_value').mask("#.##0,00", {reverse: true});
        $('#card_number').mask('0000 0000 0000 0000');
        $('#validation_date').mask('00-0000');
        $('#cvv').mask('000');
    </script>
</body>

</html>