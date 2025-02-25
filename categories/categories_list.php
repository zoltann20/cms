<?php
$db->logincheck('uID');
    $db->DBquery("SELECT
    ID AS '.ID',
    name AS 'Kategória',
    status AS '.status'
    FROM categories AS Kategóriák");
    
    $db->toTable("c|s|i|u|d");
?>