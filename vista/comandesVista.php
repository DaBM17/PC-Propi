<?php
    //session_start();
    function mostrarComandes()
    {
        include_once "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
        include_once "/home/TDIW/tdiw-a4/public_html/model/consultes.php";

        $my_connexion = connectaDB();
        $consulta = consultaIdUsuari($my_connexion, $_SESSION['email']);
        $row = pg_fetch_assoc($consulta);
        $userId = $row['id'];
        $consulta = consultaComandesUsuari($my_connexion, $userId); //RETORNA ELS IDs I DATES DE TOTES LES COMANDES DEL USUARI
        if (pg_num_rows($consulta) > 0)
        {
            while ($row = pg_fetch_assoc($consulta))
            {
                $consulta2 = consultaLiniaComanda($my_connexion, $row['id']); //RETORNA NOM, QUANTITAT DEL PRODUCTE, PREU I ID DE LA COMANDA
                if (pg_num_rows($consulta2) > 0)
                {
                    while ($row2 = pg_fetch_assoc($consulta2))
                    {
                        $consulta3 = consultaImgProducte($my_connexion, $row2['nom_producte']);
                        $consultaData = consultaDataComanda($my_connexion, $row2['comanda_id']);
                        $row3 = pg_fetch_assoc($consulta3);
                        $rowData = pg_fetch_assoc($consultaData);
                        $data = new DateTime($rowData['data']);
                        $dataFinal = $data->format('Y-m-d');
                        echo '<p>Nom: ' . $row2['nom_producte'] . ' | Quantitat: ' . $row2['quantitat'] . ' | Preu total: ' . $row2['preu_total'] .' | Data: ' . $dataFinal . '</p>';
                        echo '<img src="' . $row3['imatge'] . '" alt="imgProd" width="125px"></a>';
                        echo '<br>';
                    }
                }
            }
        }
    }