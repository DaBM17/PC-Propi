<?php
    //session_start();
    function afegir($id)
    {
        $_SESSION['last_prod'] = $id;
        $_SESSION['num_productes'] = $_SESSION['num_productes'] + $_POST['num_prod'];

        if (!isset($_SESSION[$id]))
        {
            $_SESSION[$id] = $_POST['num_prod'];
        }
        else
        {
            $_SESSION[$id] = $_SESSION[$id] + $_POST['num_prod'];
        }

        if (isset($_SESSION['prod_array']))
        {
            $lon = count($_SESSION['prod_array']);
            $_SESSION['prod_array'][$lon] = $_SESSION['last_prod'];
        }
        else
        {
            $_SESSION['prod_array'][0] = $_SESSION['last_prod'];
        }

        if (isset($_SESSION['quantitats']))
        {
            $lon = count($_SESSION['quantitats']);
            $_SESSION['quantitats'][$lon] = $_POST['num_prod'];
        }
        else
        {
            $_SESSION['quantitats'][0] = $_SESSION['num_productes'];
        }

        include_once "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
        $my_connexion = connectaDB();

        $sql_consulta = "SELECT * FROM producte WHERE id_producte = '$id'";
        $consulta = pg_query($my_connexion, $sql_consulta) or die("Error sql");
        if (pg_num_rows($consulta) > 0)
        {
            while ($row = pg_fetch_assoc($consulta))
            {
                $preu_total = $_SESSION[$row['id_producte']] * $row['preu'];
            }
            $_SESSION['import_total'] = $_SESSION['import_total'] + $preu_total;
        }

        //header("Location: https://tdiw-a4.deic-docencia.uab.cat/producte.php?prodID=" . $id);
    }
?>
