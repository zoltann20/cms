<?php
    $db->DBquery("SELECT
    contents.date AS 'date',
    contents.title AS 'title',
    categories.name AS 'cat_name'
    FROM contents
    INNER JOIN categories ON categories.ID = contents.catID");
    $db->toCalendar('Tartalom', 'date', 'date', 'cat_name|title', 'calendar');
    echo '<div id="calendar"></div>';
?>