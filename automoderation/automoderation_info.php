<?php
$db->logincheck('uID');
    $db->DBquery("SELECT 
    ID AS 'Azonosító',
    word AS 'A tiltott szó'
    FROM automoderation
    WHERE automoderation.ID=".$id);

    $db->showRecord();
?>