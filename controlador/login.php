<?php
    session_start();
    function validarDadesLogin()
    {
        if (isset($_POST['login']) && !empty($_POST['correu']) && !empty($_POST['contrasenya']))
        {
            include_once "/home/TDIW/tdiw-a4/public_html/model/connectDB.php";
            include_once "/home/TDIW/tdiw-a4/public_html/model/consultes.php";

            $my_connexion = connectaDB();
            $userPwd = consultaCorreuPassword($my_connexion);
            if (pg_num_rows($userPwd) > 0)
            {
                $valid_email = false;
                $valid_pwd = false;

                while (($row = pg_fetch_assoc($userPwd)) && ($valid_pwd == false or $valid_email == false))
                {
                    $valid_pwd = password_verify($_POST['contrasenya'], $row['password']);
                    if ($row['email'] == $_POST['correu'])
                    {
                        $valid_email = true;
                    }
                }

                if ($valid_pwd and $valid_email)
                {
                    echo "INICI DE SESSIO CORRECTE <br>";
                    $_SESSION['email'] = $_POST['correu'];
                    $_SESSION['pwd'] = $_POST['contrasenya'];
                    $_SESSION['num_productes'] = 0;
                    header("Location: https://tdiw-a4.deic-docencia.uab.cat/main_page.php");
                }
                else
                {
                    echo "Correu o contrasenya incorrectes <br>";
                }
            }
        }
    }
?>