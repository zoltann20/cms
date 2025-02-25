<?php
$db->logincheck('uID');
    $db->DBquery("SELECT 
    contents.ID AS 'Azonosító',
    categories.name AS 'Kategória',
    contents.postpicture AS 'Kép',
    contents.title AS 'Cím',
    contents.short AS 'Rövid tartalom',
    contents.content AS 'Tartalom',
    contents.date AS 'Dátum',
    users.name AS 'Felhasználó',
    contents.status AS 'Státusz',
    (SELECT COUNT(*) FROM comments WHERE contentID=$id) AS 'Hosszászólások száma',
    (SELECT COUNT(*) FROM attachments WHERE contentID=$id) AS 'Csatolmányok száma'
    FROM contents
    INNER JOIN categories ON categories.ID = contents.catID
    INNER JOIN users ON users.ID = contents.userID
    LEFT JOIN comments ON comments.contentID = contents.ID
    LEFT JOIN attachments ON attachments.contentID = contents.ID
    WHERE contents.ID=".$id);

    $db->showRecord();
?>