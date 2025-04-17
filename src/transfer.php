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
    <link rel="stylesheet" href="./assets/css/operations.css">
    <link rel="stylesheet" href="./assets/css/form.css">
    <title>TRANSFERÊNCIAS</title>
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
        <h1>Transferências</h1>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label for="addressee_number">Telemóvel do destinatário</label>
            <input type="text" name="addressee_number" id="addressee_number" class="input-user" require placeholder="ex: 921 123 456">

            <label for="value">Valor a enviar</label>
            <input type="text" name="value" id="value" class="input-user" require placeholder="ex: 10.000,00">

            <input type="submit" value="Enviar" class="btn">
        </form>
    </main>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User(0, '', $email, $password);
            $amount_to_transfer = formatCurrencyToFloat($_POST['value']);

            if ($user->transfer(Connection::connect(), $amount_to_transfer, $_POST['addressee_number'], 'Concluída')) {
                header('Location: http://localhost/_global-express/src/home.php');
                exit();
            } else {
                echo "
                    <script>
                        alert('Falha ao efectuar transferência!')
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
        $('#addressee_number').mask('+244 000-000-000')
        $('#value').mask("#.##0,00", {reverse: true});
    </script>
</body>

</html>