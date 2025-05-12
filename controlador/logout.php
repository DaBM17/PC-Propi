<?php
    session_start();
    if (isset($_SESSION))
    {
        session_unset();
        session_destroy();
        unset($_FILES['img_perfil']);
    }
    header("Location: https://tdiw-a4.deic-docencia.uab.cat/main_page.php");
?>