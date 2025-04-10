<?php
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/profile.css">
    <title>PERFIL</title>
</head>

<body>
    <div class="box hidde">
        <header class="head">
            <div class="close">
                <span class="material-icons">
                    close
                </span>
            </div>
        </header>
        <main class="body">
            <section class="user-data">
                <div class="profile-foto">
                </div>
                <span class="user-name"><?=$name?></span>
                <span>Conta pessoal</span>
            </section>
            <section class="operations">
                <div class="options">
                    <h2 class="option-title">Sua conta</h2>

                    <div class="option-card">
                        <div>
                            <span class="material-icons right">
                                notifications
                            </span>
                            <article>
                                <h3>Notificações</h3>
                                <p>Customize a forma como recebe notificações</p>
                            </article>
                        </div>
                        <span class="material-icons" onclick="window.location.href=''">
                            keyboard_arrow_right
                        </span>
                    </div>
                    <div class="option-card">
                        <div>
                            <span class="material-icons right">
                                question_mark
                            </span>
                            <article>
                                <h3>Ajuda</h3>
                                <p>Obtenha suporte 24/24</p>
                            </article>
                        </div>
                        <span class="material-icons" onclick="window.location.href=''">
                            keyboard_arrow_right
                        </span>
                    </div>
                </div>
                <div class="options">
                    <h2 class="option-title">Definições</h2>

                    <div class="option-card">
                        <div>
                            <span class="material-icons right">
                                shield
                            </span>
                            <article>
                                <h3>Segurança</h3>
                                <p>Altere as suas definições de privacidade e segurança</p>
                            </article>
                        </div>
                        <span class="material-icons" onclick="window.location.href=''">
                            keyboard_arrow_right
                        </span>
                    </div>
                    <div class="option-card">
                        <div>
                            <span class="material-icons right">
                                account_circle
                            </span>
                            <article>
                                <h3>Informação pessoal</h3>
                                <p>Actualize a sua informação pessoal</p>
                            </article>
                        </div>
                        <span class="material-icons" onclick="window.location.href=''">
                            keyboard_arrow_right
                        </span>
                    </div>
                </div>
                <div class="options">
                    <h2 class="option-title">Acções</h2>

                    <div class="option-card">
                        <div>
                            <span class="material-icons right">
                                logout
                            </span>
                            <article>
                                <h3>Log out</h3>
                                <p>Terminar sessão</p>
                            </article>
                        </div>
                        <span class="material-icons" onclick="window.location.href='./sair.php'">
                            keyboard_arrow_right
                        </span>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="./assets/js/script.js"></script>
</body>

</html>