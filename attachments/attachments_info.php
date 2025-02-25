<?php
    $db->logincheck('uID');

    $db->DBquery("SELECT
    attachments.filename AS 'Fájlnév',
    attachments.ID AS 'Azonosító',
    contents.title AS 'Tartalom',
    users.name AS 'Feltöltő neve',
    attachments.dir AS 'Könyvtár',
    (attachments.size/1048576) AS 'Méret (MB)',
    attachments.type AS 'Típus',
    attachments.date AS 'Feltöltés dátuma'
    FROM attachments
    INNER JOIN contents ON contents.ID = attachments.contentID
    INNER JOIN users ON users.ID = attachments.userID
    WHERE attachments.ID=".$id);

    $db->showRecord();
?>