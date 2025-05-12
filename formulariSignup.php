<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre d'usuari</title>
    <link rel="stylesheet" type="text/css" href="css/formulariSignup.css">
    <script src="js/funcions.js"></script>
</head>
<body>
<?php
    if (isset($_POST['signup']))
    {
        include_once "/home/TDIW/tdiw-a4/public_html/controlador/registre.php";
        $res = registrar();
    }
?>
<header>
    <div id="nombre"><a href="main_page.php">PC Propi</a></div>
</header>
<?php if (isset($res)) {
    echo '<h3>' . $res . '</h3>';
    if ($res = "Registre fet correctament!")
    {
        echo '<a href="formulariLogin.php">Inicia Sessió amb el teu nou compte fent click aquí!</a>';
    }
}
?>
<h1> Registra't en la nostra web</h1>
<p>Introdueix les teves dades:</p>
<form method="post" id="formulari-registre">
    <label for="nom">Nom:</label>
    <input id="nom" type="text" name="nom" maxlength="30" size="20" required>
        <br>
        <br>
    <label for="e-mail">E-mail:</label>
    <input type="email" name="e-mail" id="e-mail" placeholder="example@gmail.com" required>
        <br>
        <br>
    <label for="passw">Contrasenya:</label>
    <input type="password" name="password" id="passw" required>
        <br>
        <br>
    <label for="address">Adreça:</label>
    <input type="text" name="address" id="address" maxlength="30" required>
        <br>
        <br>
    <label for="poblacio">Població:</label>
    <input type="text" name="poblacio" id="poblacio" maxlength="30" required>
        <br>
        <br>
    <label for="cp">Codi Postal:</label>
    <input type="text" name="codi_postal" id="cp" pattern="\d{5}" required>
        <br>
        <br>
    <input type="submit" name="signup" value="Crear Compte">
</form>
</body>
</html>