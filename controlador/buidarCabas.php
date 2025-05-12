<?php
    session_start();
    unset($_SESSION['num_productes']);
    unset($_SESSION['import_total']);
    unset($_SESSION['prod_array']);
    unset($_SESSION['quantitats']);
    header("Location: https://tdiw-a4.deic-docencia.uab.cat/cabas.php");
