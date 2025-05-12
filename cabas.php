<?php
    if (!isset($_SESSION['import_total']))
    {
        $_SESSION['import_total'] = 0;
    }

    if (!isset($_SESSION['num_productes']))
    {
        $_SESSION['num_productes'] = 0;
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
</header>
<?php
    include __DIR__ . "/vista/cabasVista.php";

    mostrarProductesCabas();
?>
<footer>
    <a href="https://www.uab.cat/"><img src="img/UAB-2linies-verd.svg" width="300px"></a>
    <p>&copy; 2023 TDIW-a4</p>
</footer>
</body>
</html>