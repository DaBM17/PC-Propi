<?php
    session_start();
    include "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
    function mostrarProductesCabas()
    {
        $preu_final = 0;
        if (isset($_SESSION['email']) && isset($_SESSION['prod_array']))
        {
            $my_connexion = connectaDB();
            foreach ($_SESSION['prod_array'] as $valor)
            {
                $sql_consulta = "SELECT * FROM producte WHERE id_producte = '$valor'";
                $consulta = pg_query($my_connexion, $sql_consulta) or die("Error sql");
                if (pg_num_rows($consulta) > 0)
                {
                    while ($row = pg_fetch_assoc($consulta))
                    {
                        $preu_total = $_SESSION[$row['id_producte']] * $row['preu'];
                        echo '<img src="' . $row['imatge'] . '" id="product_pic" alt="producte" width="250px"></a>';
                        echo '<p>'. $row['nom'] .' | Quantitat: '. $_SESSION[$row['id_producte']] .'</p>';
                        echo '<p>Import del producte:'. $preu_total .'€</p>';
                        echo '<br>';
                        $preu_final = $preu_final + $preu_total;
                    }
                    $_SESSION['import_total'] = $preu_final;
                }
            }
        }

        echo '<p><b>Import final de la comanda: '. $preu_final .'€</b></p>';

        if (isset($_SESSION['email']) && isset($_SESSION['prod_array']))
        {
            echo '<form action="../controlador/processarComanda.php">';
            echo '<button type="submit">Finalitzar Comanda</button>';
            echo '</form>';
            echo '<br>';
            echo '<form action="../controlador/buidarCabas.php">';
            echo '<button type="submit">Buidar el Cabas</button>';
            echo '</form>';
        }
    }