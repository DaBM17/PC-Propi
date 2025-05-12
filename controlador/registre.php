<?php
    function registrar()
    {
        include_once "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
        $my_connexion = connectaDB();
        $nom = $_POST['nom'];
        $email = $_POST['e-mail'];
        $password = $_POST['password'];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $address = $_POST['address'];
        $poblacio = $_POST['poblacio'];
        $codi_postal = $_POST['codi_postal'];
        $sql_consulta_id_usuari = "SELECT MAX(id) as id FROM usuari";
        $consulta_id_usuari = pg_query($my_connexion, $sql_consulta_id_usuari) or die("Error sql");

        if (pg_num_rows($consulta_id_usuari) > 0)
        {
            while ($row = pg_fetch_assoc($consulta_id_usuari))
            {
                $my_id = $row['id'];
            }
            $my_id = $my_id + 1;
        }
        else
        {
            $my_id = 1;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $valid_email = true;
        }
        else
        {
            $valid_email = false;
        }

        $valid_cp = true;
        for ($i = 0; $i < strlen($codi_postal); $i++)
        {
            $carac = $codi_postal[$i];
            $ascii_val = ord($carac);
            if (($ascii_val < 48) or ($ascii_val > 57))
            {
                $valid_cp = false;
            }
        }

        if ($valid_cp and $valid_email)
        {
            $sql_insert = "INSERT INTO usuari (id, email, password, nom, codi_postal, adreca, poblacio) 
                VALUES ($1, $2, $3, $4, $5, $6, $7)";

            $stmt = pg_prepare($my_connexion, "", $sql_insert);

            $resultat = pg_execute($my_connexion, "", array($my_id, $email, $hash_password, $nom, $codi_postal, $address, $poblacio));

            if ($resultat) {
                $resReg = "Registre fet correctament!";
            } else {
                $resReg = "Error en el registre: " . pg_last_error($my_connexion);
            }
        }
        else
        {
            $resReg = "Dades no valides";
        }

        return $resReg;
    }
?>