<?php
    session_start();

    if (isset($_FILES['img_perfil']))
    {
        unset($_FILES['img_perfil']);
    }

    if (!isset($_SESSION['import_total']))
    {
        $_SESSION['import_total'] = 0;
    }

    if (!isset($_SESSION['num_productes']))
    {
        $_SESSION['num_productes'] = 0;
    }

    if (isset($_SESSION['email']))
    {
        include_once __DIR__ . "/model/connectDB.php";
        include_once __DIR__ . "/model/consultes.php";
        $my_connexion = connectaDB();
        $queryImg = consultaImgPerfil($my_connexion, $_SESSION['email']);
        $row = pg_fetch_assoc($queryImg);
        if ($row['img_perfil'] != null)
        {
            $profilePic = $row['img_perfil'];
        }
        else
        {
            $profilePic = "img/Sample_User_Icon.png";
        }
    }

    if (!isset($_SESSION['email']))
    {
        $profilePic = "img/Sample_User_Icon.png";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Propi</title>
    <link rel="stylesheet" type="text/css" href="css/cabas.css">
    <script src="js/funcions.js"></script>
</head>
<body>
<header>
    <div id="nombre"><a href="main_page.php">PC Propi</a></div>
    <div id="user">
        <img src=<?php echo $profilePic; ?> id="user_pic" onclick="menuUsuari()">
        <div id="menu-desplegable">
            <?php if (!isset($_SESSION['email'])) { ?>
                <a href="formulariSignup.php">Crear Compte</a>
                <a href="formulariLogin.php">Iniciar Sessió</a>
            <?php } ?>
            <?php if (isset($_SESSION['email'])) { ?>
                <a href="controlador/logout.php">Tancar Sessió</a>
                <a href="llistatComandes.php">Comandes</a>
                <br>
                <a href="perfil.php">Perfil</a>
            <?php } ?>
        </div>
    </div>
    <div id="compra">
        <a href="cabas.php"><img src="img/basket-cart-icon-27.png" alt="Compra" id="shopping_cart"></a>
    </div>
</header>
<?php
    include __DIR__ . "/vista/comandesVista.php";

    mostrarComandes();
?>
<footer>
    <a href="https://www.uab.cat/"><img src="img/UAB-2linies-verd.svg" width="300px"></a>
    <p>&copy; 2023 TDIW-a4</p>
</footer>
</body>
</html>
