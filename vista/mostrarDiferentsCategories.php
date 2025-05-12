<?php
    function mostrarTotesCategories($cat)
    {
        if (pg_num_rows($cat) > 0)
        {
            $i = 0;
            while ($row = pg_fetch_assoc($cat))
            {
                $escaped_id = htmlentities($row['id'],ENT_QUOTES |ENT_HTML5, 'UTF-8');
                $escaped_img = htmlentities($row['imatge'],ENT_QUOTES |ENT_HTML5, 'UTF-8');
                $escaped_nom = htmlentities($row['nom'],ENT_QUOTES |ENT_HTML5, 'UTF-8');

                if ($i % 3 == 0)
                {
                    echo '<div class="image-container">';
                }
                echo '<div>';
                echo '<a href="categoria.php?catID=' . $escaped_id .'"><img src="' . $escaped_img . '" alt="' . $escaped_nom . '" width="300px"></a>';
                echo '<p class="image-caption">' . $escaped_nom . '</p>';
                echo '</div>';
                if ($i == 2 || $i == 4)
                {
                    echo '</div>';
                }
                $i = $i + 1;
            }
        }
    }
?>