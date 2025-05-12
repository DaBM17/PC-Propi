<?php
    function mostrarDadesProducte($id)
    {
        include_once "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
        include_once "/home/TDIW/tdiw-a4/public_html/model/consultes.php";
        include_once "/home/TDIW/tdiw-a4/public_html/vista/mostrarInformacioProducte.php";

        if (isset($_GET['prodID']))
        {
            //$prodID = $_GET['prodID'];
            //$prodID = pg_escape_string($prodID);
            $my_connexion = connectaDB();

            $consulta_productes = consultaDadesProducte($my_connexion, $id);

            mostrarDades($consulta_productes);
        }
    }
?>