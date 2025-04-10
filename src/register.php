<?php
    session_start();
    require_once('./php/Connection.php');
    require_once('./php/User.php');
    date_default_timezone_set('Africa/Luanda');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = new User("", $_POST['name'], $_POST['email'], $_POST['password'], "", $_POST['tel_number'], $_POST['date'], date('Y-m-d H:i:s'));

        if ($user->register(Connection::connect())) {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];

            header('Location: http://localhost/_global-express/src/home.php');
            exit();    
        } else {
            unset($_POST['name']);
            unset($_POST['email']);
            unset($_POST['password']);

            header('Location: http://localhost/_global-express/src/register.php');
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO</title>
    <link rel="stylesheet" href="./assets/css/form.css">
</head>

<body>
    <header class="head">
        <div class="logo"></div>
    </header>
    <main class="body">
        <section class="box">
            <section class="ilustration">
                <picture>
                    <source media="(min-width: 950px)" srcset="./assets/images/undraw_forms_1ciz-400w.png">
                    <img src="./assets/images/undraw_forms_1ciz-300w.png" alt="Ilustração de pagamentos digitais">
                </picture>
            </section>
            <section class="form-parent">
                <h1>Olá de novo!</h1>
                <p>Já tem uma conta? <a href="../index.php" rel="next" hreflang="pt-AO">Login</a></p>
                <form class="form cadastro" method="post" action="<?=$_SERVER['PHP_SELF']?>">
                    <label for="name">O seu nome</label>
                    <input type="text" name="name" id="name" class="input-user small" required>

                    <label for="email">O seu endereço de email</label>
                    <input type="email" name="email" id="email" class="input-user small" required>

                    <label for="tel_number">O seu número de telemóvel</label>
                    <input type="tel" name="tel_number" id="tel_number" class="input-user small" required>

                    <label for="date">A sua data de nascimento</label>
                    <input type="text" name="date" id="date" class="input-user" placeholder="AAAA/MM/DD" required>

                    <label for="password">A sua password</label>
                    <input type="password" name="password" id="password" class="input-user" required>

                    <input type="submit" value="Cadastrar" class="btn">
                </form>
            </section>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $('#tel_number').mask('+244 000-000-000')
        $('#date').mask('0000-00-00');
    </script>
</body>

</html>