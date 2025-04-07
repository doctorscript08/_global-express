<?php
    session_start();
    require_once('./php/Connection.php');
    require_once('./php/User.php');
    date_default_timezone_set('Africa/Luanda');

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
            <a onclick="javacript:history.go(-1)">
                <span class="material-icons">
                    arrow_back
                </span>
            </a>
        </div>
    </header>
    <main class="body">
        <h1>Carregamentos</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label for="card_number">Número do cartão</label>
            <input type="text" name="card_number" id="card_number" class="input-user" require placeholder="0000 0000 0000 0000">

            <label for="validation_date">Data de validade</label>
            <input type="text" name="validation_date" id="validation_date" class="input-user" placeholder="MM-AAAA" required>
            
            <label for="cvv">CVV</label>
            <input type="number" name="cvv" id="cvv" class="input-user" placeholder="000" required>

            <input type="submit" value="Carregar" class="btn">
        </form>

        <?php
            if (isset($_SESSION['payment_method'], $_SESSION['pay_value'])) {
                $pay_value = $_SESSION['pay_value'];
                $payment_method = $_SESSION['payment_method'];
                $card_number = $_POST['card_number'];
                $validation_date = $_POST['validation_date'];
                $cvv = $_POST['cvv'];
                $year_date = (int) substr($validation_date, 0, 3);
                $month_date = (int) substr($validation_date, 5, 2);
                $upload_date = date('Y-m-d H:i:s');

                if ((strlen($card_number) === 16) && (strlen($validation_date) === 7) && (strlen($cvv) === 3) && ($year_date >= date('Y') && ($month_date >= date('m')))) {
                    $user = new User(0, '', $email, $password);

                    if ($user->upload(Connection::connect(), $pay_value, $payment_method, $upload_date)) {
                        echo "
                            <script>
                                alert('Carregamento efectuado com sucesso!')
                                window.location.href='home.php'
                            </script>
                        ";
                    } else {
                        echo "
                            <script>
                                alert('Falha ao efectuar carregamento!')
                                window.location.href='home.php'
                            </script>
                        ";
                    }
                }
            }
        ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $('#card_number').mask('0000 0000 0000 0000');
        $('#validation_date').mask('00-0000');
        $('#cvv').mask('000');
    </script>
</body>

</html>