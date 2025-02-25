<?php
$db->logincheck('uID');
    $db->DBquery("SELECT 
    Tartalmak.ID AS '.ID',
    categories.name AS 'Kategória',
    Tartalmak.title AS 'Cím',
    (SELECT COUNT(*) FROM comments WHERE contentID=`.ID`) AS '<svg class=\"bi\" width=\"20\" height=\"20\" fill=\"currentColor\"><use xlink:href=\"icons/bootstrap-icons.svg#chat-right-text-fill\"/></svg>',
    (SELECT COUNT(*) FROM attachments WHERE contentID=`.ID`) AS '<svg class=\"bi\" width=\"20\" height=\"20\" fill=\"currentColor\"><use xlink:href=\"icons/bootstrap-icons.svg#tags-fill\"/></svg>',
    Tartalmak.date AS 'Dátum',
    Tartalmak.status AS '.status'
    FROM contents AS Tartalmak
    INNER JOIN categories ON categories.ID = Tartalmak.catID");
    $db->toTable('c|s|i|a|u|d');
?>