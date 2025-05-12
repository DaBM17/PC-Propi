<?php
    //session_start();

    function mostrarDades($prod)
    {
        if (pg_num_rows($prod) > 0)
        {
            $aux = pg_fetch_assoc($prod);

            if (isset($_POST['afegir']) && !empty($_POST['num_prod']))
            {
                include __DIR__ . "/afegirProducteCabas.php";

                afegir($aux['id_producte']);
            }

            echo '<h1>'. $aux['nom'] .'</h1>';
            echo '<div class="image-container">';
            echo '<div class="producto">';
            echo '<img src="' . $aux['imatge'] . '" id="product_pic" alt="' . $aux['nom'] . '" width="250px"></a>';
            echo '<p>Preu: ' . $aux['preu'] . '€</p>';
            echo '<p>Descripció: ' . $aux['descripcio'] . ' </p>';
            echo '<br>';
            echo '<br>';
            if (isset($_SESSION['email']))
            {
                echo '<form method="post">';
                echo '<label for="quantitat">Quantes unitats vols comprar:</label>';
                echo '<input type="number" name="num_prod" id="np" min="0" step="1">';
                echo '<br>';
                echo '<input type="submit" id="afegir" name="afegir" value="Afegir a la compra" onclick="updateCabas(\'' . $_SESSION['num_productes'] . '\');">';
                echo '</form>';
            }
            else
            {
                echo '<a href="https://tdiw-a4.deic-docencia.uab.cat/formulariLogin.php"><b>Inicia sessió per comprar</b></a>';
            }
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
    }