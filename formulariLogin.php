<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Propi</title>
    <link rel="stylesheet" type="text/css" href="css/formulariSignup.css">
</head>
<body>
<header>
    <div id="nombre"><a href="main_page.php">PC Propi</a></div>
</header>
<h1>Inicia Sessió</h1>
<p>Introdueix les teves dades:</p>
<?php
    include_once "/home/TDIW/tdiw-a4/public_html/controlador/login.php";

    validarDadesLogin();
?>
<form method="post">
    <label for="e-mail">E-mail:</label>
    <input type="email" name="correu" id="correu" placeholder="example@gmail.com" required>
        <br>
        <br>
    <label for="password">Contrasenya:</label>
    <input type="password" name="contrasenya" id="passw" required>
        <br>
        <br>
    <input type="submit" name="login" value="Entrar">
</form>
<p>No tens compte? <a href="formulariSignup.php">Registra't fent click aquí!</a></p>
</body>
</html>