<?php
$db->logincheck('uID');
    $db->DBquery("SELECT 
    ID AS 'Azonosító',
    name AS 'Kategória',
    status AS 'Státusz'
    FROM categories
    WHERE categories.ID=".$id);

    $db->showRecord();
?>