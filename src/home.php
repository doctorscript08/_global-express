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
    <title>Document</title>
</head>
<body>
    home
    <a href="sair.php">sair</a>
</body>
</html>