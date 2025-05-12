<?php
    function mostrarProducte($id)
    {
        include_once "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
        include_once "/home/TDIW/tdiw-a4/public_html/model/consultes.php";
        include_once "/home/TDIW/tdiw-a4/public_html/vista/mostrarProductesCategoria.php";

        if (isset($_GET['catID']))
        {
            $my_connexion = connectaDB();
            $consulta_categoria = consultaCategories($my_connexion, $_GET['catID']);
            $consulta_productes = consultaProductes($my_connexion, $_GET['catID']);
            mostrarProductes($consulta_categoria, $consulta_productes);
        }
    }
?>