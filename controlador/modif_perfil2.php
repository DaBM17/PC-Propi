<?php
    session_start();

    include_once "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
    include_once "/home/TDIW/tdiw-a4/public_html/model/consultes.php";

    $updatePass = false;

    foreach ($_POST as $clau => $valor)
    {
        if (!empty($valor) && $clau != 'password')
        {
            $_SESSION['dades_usuari'][$clau] = $valor;
            if ($clau == 'email')
            {
                $_SESSION['email'] = $valor;
            }
        }
        elseif ($clau == 'password' && !empty($valor))
        {
            $password = $_POST['password'];
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $_SESSION['dades_usuari']['password'] = $hash_password;
            $updatePass = true;
        }
    }

    if (isset($_FILES['img_perfil']) && $_FILES['img_perfil']['error'] == UPLOAD_ERR_OK)
    {
        $nom_img = $_FILES["img_perfil"]["name"];
        $ruta_tmp = $_FILES["img_perfil"]["tmp_name"];
        $ruta_dest = "/home/TDIW/tdiw-a4/public_html/img/" . $nom_img;
        $res_move = move_uploaded_file($ruta_tmp, $ruta_dest);
        if ($res_move)
        {
            $_SESSION['dades_usuari']['img_perfil'] = "img" . "/" . $nom_img;
            $my_connexion = connectaDB();
            $resultat = updateUsusariAmbImg($my_connexion, $_SESSION['dades_usuari']['id'], $_SESSION['dades_usuari']);
            unset($_FILES);
        }
        else
        {
            $resultat = false;
        }
    }
    else
    {
        $my_connexion = connectaDB();
        $resultat = updateUsuariSenseImg($my_connexion, $_SESSION['dades_usuari']['id'], $_SESSION['dades_usuari']);
        unset($_FILES);
    }

    if ($updatePass)
    {
        $my_connexion = connectaDB();
        $resultat = updatePassword($my_connexion, $_SESSION['dades_usuari']['id'], $_SESSION['dades_usuari']);
    }

    if ($resultat)
    {
        $resultatProces = 'INSERCIO CORRECTA';
        $_SESSION['modif'] = true;
    }
    else
    {
        $resultatProces = 'INSERCIO INCORRECTA';
        $_SESSION['modif'] = false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PC Propi</title>
    <link rel="stylesheet" type="text/css" href="../css/formulariSignup.css">
    <script src="../js/funcions.js"></script>
</head>
<body>
<header>
    <div id="nombre">
        <a href="../main_page.php">PC Propi</a>
    </div>
</header>
<div class="container">
    <h1 id="resultat"><?php echo $resultatProces; ?></h1>
    <a href="../formulariLogin.php">Torna a iniciar sessió amb les noves dades fent click aquí!</a>
</div>
</body>