<?php
    session_start();
    //INSERIR EN LA BASE DE DADES
    //BUIDAR CABAS
    //MOSTRAR MISSATGE DE CONFIRMACIO
    include "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
    include "/home/TDIW/tdiw-a4/public_html/model/consultes.php";
    $my_connexion = connectaDB();

    $consulta = consultaIdUsuari($my_connexion, $_SESSION['email']);

    while ($row = pg_fetch_assoc($consulta))
    {
        $user_id = $row['id'];
    }

    $consulta = consultaIdComanda($my_connexion);
    if (pg_num_rows($consulta) > 0)
    {
        while ($row = pg_fetch_assoc($consulta))
        {
            $id = $row['id'];
        }
        $id = $id + 1;
    }
    else
    {
        $id = 1;
    }

    $import_total = $_SESSION['import_total'];

    $sql_insert = "INSERT INTO comanda (import_total, id, usuari_id) VALUES ($1, $2, $3)";
    $stmt = pg_prepare($my_connexion, "", $sql_insert);
    $resultat = pg_execute($my_connexion, "", array($import_total, $id, $user_id));

    //INSERIR A LINIA COMANDA: nom_producte, quantitat, preu_total, comanda_id

    for ($i = 0; $i < count($_SESSION['prod_array']); $i++)
    {
        //$consulta = consultaNomProducte($my_connexion, $_SESSION['prod_array'][$i]);
        $sql_consulta = "SELECT nom FROM producte WHERE id_producte = '{$_SESSION['prod_array'][$i]}'";
        $consulta = pg_query($my_connexion, $sql_consulta) or die("Error sql");
        $row = pg_fetch_assoc($consulta);
        $nom_producte = $row['nom'];

        if (isset($_SESSION['quantitats'][$i]))
        {
            $quantitat = $_SESSION['quantitats'][$i];
        }
        else
        {
            $quantitat = 1;
        }

        $preu_total = $_SESSION['import_total'];
        $sql_insert = "INSERT INTO linia_comanda (nom_producte, quantitat, preu_total, comanda_id) VALUES ($1, $2, $3, $4)";
        $stmt = pg_prepare($my_connexion, "", $sql_insert);
        $resultat2 = pg_execute($my_connexion, "", array($nom_producte, $quantitat, $preu_total, $id));
    }

    if ($resultat && $resultat2)
    {
        $resultatProces = 'COMPRA FETA CORRECTAMENT';
        unset($_SESSION['num_productes']);
        unset($_SESSION['import_total']);
        unset($_SESSION['prod_array']);
        unset($_SESSION['quantitats']);
    }
    else
    {
        $resultatProces = 'NO HEM POGUT PROCESSAR LA COMANDA';
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
    </div>
</body>