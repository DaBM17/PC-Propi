<?php
    session_start();

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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Propi</title>
    <link rel="stylesheet" type="text/css" href="css/main_page.css">
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
    include_once "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
    include_once "/home/TDIW/tdiw-a4/public_html/model/consultes.php";

    $my_connexion = connectaDB();
    $dadesUsuari = consultaDadesUsuari($my_connexion, $_SESSION['email']);
    $row = pg_fetch_assoc($dadesUsuari);
    $_SESSION['dades_usuari'] = $row;
?>

<div id="info_comandes_usuari">
    <h1> EDITAR PERFIL </h1>
    <!--comprovar que l'usuari està registrat-->
    <?php
    if( !isset($_SESSION['email']) && !(empty($_SESSION['email']) ) ){?>
        <p> Cal iniciar sessió </p>
    <?php   }
    else{ //mostrem el formulari amb les dades guardades de l'usuari?>
        <form method="post" action="../controlador/modif_perfil2.php" enctype="multipart/form-data">
            <label for="correu">E-mail:</label>
            <input type="email" name="email" id="correu" placeholder=<?php echo"{$row["email"]}"?>>
            <br>
            <br>
            <label for="Nom">Nom:</label>
            <input type="text" name="nom" id="nom" placeholder=<?php echo"{$row["nom"]}"?>>
            <br>
            <br>
            <label for="password">Contrasenya:</label>
            <input type="password" name="password" id="passw" placeholder="********">
            <br>
            <br>
            <label for="address">Adreça:</label>
            <input type="text" name="adreca" id="address" maxlength="30" placeholder=<?php echo"{$row["adreca"]}"?>>
            <br>
            <br>
            <label for="poblacio">Població:</label>
            <input type="text" name="poblacio" id="poblacio" maxlength="30" placeholder=<?php echo"{$row["poblacio"]}"?>>
            <br>
            <br>
            <label for="cp">Codi Postal:</label>
            <input type="text" name="codi_postal" id="cp" pattern="\d{5}" placeholder=<?php echo"{$row["codi_postal"]}"?>>
            <br>
            <br>
            <label for="imatge_perfil">Imatge de perfil:</label>
            <input type="file" name="img_perfil" id="imatge_perfil" accept="image/*">
            <br>
            <br>
            <input type="submit" value="Modificar">
        </form>
    <?php }?>

</div>
</body>

</html>