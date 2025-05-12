<?php
    function consultaProductes($conn, $id)
    {
        $sql_consulta_productes = "SELECT * FROM producte WHERE categoria_id = '$id'";
        $consulta_productes = pg_query($conn, $sql_consulta_productes) or die("Error sql");
        return $consulta_productes;
    }

    function consultaCategories($conn, $id)
    {
        $sql_consulta_categoria = "SELECT nom FROM categoria WHERE id ='$id'";
        $consulta_categoria = pg_query($conn, $sql_consulta_categoria) or die("Error sql");
        return $consulta_categoria;
    }

    function consultaDadesProducte($conn, $id)
    {
        $sql_consulta_productes = "SELECT * FROM producte WHERE id_producte = '$id'";
        $consulta_productes = pg_query($conn, $sql_consulta_productes) or die("Error sql");
        return $consulta_productes;
    }

    function consultaTotesCategories($conn)
    {
        $sql_consulta = "SELECT * FROM categoria";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }

    function consultaCorreuPassword($conn)
    {
        $sql_consulta = "SELECT email, password FROM usuari";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }

    function consultaIdUsuari($conn, $email)
    {
        $sql_consulta = "SELECT id FROM usuari WHERE email = '$email'";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }

    function consultaIdComanda($conn)
    {
        $sql_consulta = "SELECT id FROM comanda";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }

    function consultaNomProducte($conn, $id)
    {
        $sql_consulta = "SELECT nom FROM producte WHERE id_producte = '$id'";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }

    function consultaComandesUsuari($conn, $id)
    {
        $sql_consulta = "SELECT id FROM comanda WHERE usuari_id = '$id'";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }

    function consultaLiniaComanda($conn, $id)
    {
        $sql_consulta = "SELECT nom_producte, quantitat, preu_total, comanda_id FROM linia_comanda WHERE comanda_id = '$id'";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }

    function consultaDataComanda($conn, $id)
    {
        $sql_consulta = "SELECT data FROM comanda WHERE id = '$id'";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }

    function consultaImgProducte($conn, $nom)
    {
        $sql_consulta_productes = "SELECT imatge FROM producte WHERE nom = '$nom'";
        $consulta_productes = pg_query($conn, $sql_consulta_productes) or die("Error sql");
        return $consulta_productes;
    }

    function consultaDadesUsuari($conn, $email)
    {
        $sql_consulta = "SELECT id, email, nom, codi_postal, adreca, poblacio FROM usuari WHERE email = '$email'";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }

    function updateUsusariAmbImg($conn, $id, $dades_usuari)
    {
        $sql_update = "UPDATE usuari SET email = $1, nom = $2, codi_postal = $3, adreca = $4, poblacio = $5, img_perfil = $6
                        WHERE id = $7";
        $stmt = pg_prepare($conn, "", $sql_update);

        if ($stmt)
        {
            $valores = array($dades_usuari['email'], $dades_usuari['nom'], $dades_usuari['codi_postal'], $dades_usuari['adreca'],
                                $dades_usuari['poblacio'], $dades_usuari['img_perfil'], $dades_usuari['id']);
            $execucio = pg_execute($conn, "", $valores);
            if ($execucio)
            {
                $resultat = "EXIT AL MODIFICAR EL PERFIL";
            }
            else
            {
                $resultat = "ERROR AL MODIFICAR EL PERFIL";
            }
        }
        else
        {
            $resultat = "ERROR AL PREPARAR LA CONSULTA";
        }

        return $resultat;
    }

    function updateUsuariSenseImg($conn, $id, $dades_usuari)
    {
        $sql_update = "UPDATE usuari SET email = $1, nom = $2, codi_postal = $3, adreca = $4, poblacio = $5
                        WHERE id = $6";
        $stmt = pg_prepare($conn, "", $sql_update);

        if ($stmt)
        {
            $valores = array($dades_usuari['email'], $dades_usuari['nom'], $dades_usuari['codi_postal'], $dades_usuari['adreca'],
                $dades_usuari['poblacio'], $dades_usuari['id']);
            $execucio = pg_execute($conn, "", $valores);
            if ($execucio)
            {
                $resultat = "EXIT AL MODIFICAR EL PERFIL";
            }
            else
            {
                $resultat = "ERROR AL MODIFICAR EL PERFIL";
            }
        }
        else
        {
            $resultat = "ERROR AL PREPARAR LA CONSULTA";
        }

        return $resultat;
    }

    function updatePassword($conn, $id, $dades_usuari)
    {
        $sql_update = "UPDATE usuari SET password = $1 WHERE id = $2";
        $stmt = pg_prepare($conn, "", $sql_update);

        if ($stmt)
        {
            $valores = array($dades_usuari['password'], $dades_usuari['id']);
            $execucio = pg_execute($conn, "", $valores);
            if ($execucio)
            {
                $resultat = "EXIT AL MODIFICAR EL PERFIL";
            }
            else
            {
                $resultat = "ERROR AL MODIFICAR EL PERFIL";
            }
        }
        else
        {
            $resultat = "ERROR AL PREPARAR LA CONSULTA";
        }

        return $resultat;
    }

    function consultaImgPerfil($conn, $email)
    {
        $sql_consulta = "SELECT img_perfil FROM usuari WHERE email = '$email'";
        $consulta = pg_query($conn, $sql_consulta) or die("Error sql");
        return $consulta;
    }