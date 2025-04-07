<?php
    session_start();
    require_once('./php/Connection.php');
    require_once('./php/User.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = new User("", "", $_POST['email'], $_POST['password'], "", "", "", "");

        if ($user->login(Connection::connect())) {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];

            header('Location: http://localhost/_global-express/src/home.php');
            exit();
        } else {
            unset($_POST['email']);
            unset($_POST['password']);
            
            header('Location: http://localhost/_global-express/src/');
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/form.css">
    <title>LOGIN</title>
</head>
<body>
    <header class="head">
        <div class="logo"></div>
    </header>
    <main class="body">
        <div class="box">
            <section class="ilustration">
                <picture>
                    <source media="(min-width: 950px)" srcset="./assets/images/undraw_credit-card-payments_y0vn-400w.png">
                    <img src="./assets/images/undraw_credit-card-payments_y0vn-300w.png" alt="Ilustração de pagamentos digitais">
                </picture>
            </section>
            <section class="form-parent">
                <h1>Olá de novo!</h1>
                <p>Não tem uma conta? <a href="register.php" rel="next" hreflang="pt-AO">Cadastrar-se</a></p>
                <form class="form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
                    <label for="email">O seu endereço de email</label>
                    <input type="email" name="email" id="email" class="input-user" required>
                    <label for="password">A sua password</label>
                    <input type="password" name="password" id="password" class="input-user" required>
                    <input type="submit" value="Entrar" class="btn">
                </form>
                <p id="forget-password">
                    <a href="#" rel="next" hreflang="pt-AO">Esqueceu-se da password?</a>
                </p>
            </section>
        </div>
    </main>
</body>
</html>