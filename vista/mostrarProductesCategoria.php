<?php
    function mostrarProductes($cat, $prod)
    {
        if (pg_num_rows($prod) > 0)
        {
            $aux = pg_fetch_assoc($cat);
            echo '<h1>'. $aux['nom'] .'</h1>';
            echo '<div class="image-container">';
            while ($row = pg_fetch_assoc($prod))
            {
                echo '<div class="producto">';
                echo '<a href="producte.php?prodID=' . $row['id_producte'] .'"><img src="' . $row['imatge'] . '" alt="' . $row['nom'] . '" width="300px"></a>';
                echo '<p>Nom: ' . $row['nom'] . '</p>';
                echo '<p>Preu: ' . $row['preu'] . '€</p>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
?>