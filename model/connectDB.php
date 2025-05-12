<?php
    function connectaDB(){
        $host = "127.0.0.1";
        $dbname = "tdiw-a4";
        $user = "tdiw-a4";
        $password = "SMo7voMh";

        $connexion = pg_connect("host=$host dbname=$dbname user=$user password=$password");

        if (!$connexion)
        {
            die("Error en la connexió: ".pg_last_error());
        }
        else
        {
            return ($connexion);
        }
    }
?>
