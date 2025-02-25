<?php
    $db->DBquery("SELECT
    ID AS '.ID',
    filename AS 'Fájlnév',
    size AS 'Méret',
    type AS 'Típus',
    date AS 'Dátum'
    FROM attachments AS Csatolmányok WHERE contentID=".$id);
    if($db->numRows() != 0)
    {
        $db->toTable('i|l');
    }
?>