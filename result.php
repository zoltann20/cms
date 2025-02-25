<?php 
    $keyword = $db->escapeString($_POST['filter']);
    if(!empty($keyword))
    {
        $db->DBquery("SELECT
        contents.ID AS 'ID',
        categories.name AS 'category', 
        contents.title AS 'title', 
        contents.short AS 'short', 
        contents.date AS 'date',
        contents.content AS 'content',
        contents.postpicture AS img
        FROM contents
        INNER JOIN categories ON categories.ID = contents.catID
        WHERE
        categories.name LIKE '%$keyword%' OR
        title LIKE '%$keyword%' OR
        short LIKE '%$keyword%' OR
        content LIKE '%$keyword%'");
        echo 'A megadott kifejezésre '.$db->numRows().' találat van.';

        if($db->numRows() != 0)
        {
            $db->toGrid('title', 'category', 'short', 'date', 'img', 'contents_show');
        }
    }
?>