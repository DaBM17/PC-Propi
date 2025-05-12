<?php
    function mostrarCategories()
    {
        include_once "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
        include_once "/home/TDIW/tdiw-a4/public_html/model/consultes.php";
        include_once "/home/TDIW/tdiw-a4/public_html/vista/mostrarDiferentsCategories.php";

        $my_connexion = connectaDB();
        $categories = consultaTotesCategories($my_connexion);
        mostrarTotesCategories($categories);
    }
?>