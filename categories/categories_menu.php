<?php
    $db->DBquery("SELECT * FROM categories WHERE status = 1");
    echo '<nav class="nav d-flex justify-content-between">';

    foreach($db->queryresult as $rekord)
    {
        echo'<a class="p-2 text-muted" href="index.php?pg='.base64_encode('home&id='.$rekord['ID']).'">'.$rekord['name'].'</a>';
    }
    echo '</nav>';
?>