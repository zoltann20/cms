<?php
$db->logincheck('uID');
    $db->DBquery("SELECT
    ID AS '.ID',
    word AS 'Tiltott szavak'
    FROM automoderation AS Moderáció");
    
    $db->toTable("c|i|u|d");
?>