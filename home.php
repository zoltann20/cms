<h4 class="animated slideInDown faster">Üdvözöljük!</h4>
<hr class="animated zoomIn">
<h5 class="animated fadeIn">
    Ez egy webalkalmazás.
</h5>   
<?php

    if(isset($id))
    {
        $felt = 'AND catID = '.$id;
    }
    else
    {
        $felt = '';
    }
    $db->DBquery("SELECT
    contents.ID AS 'ID',
    categories.name AS 'category', 
    contents.title AS 'title', 
    contents.short AS 'short', 
    contents.date AS 'date',
    contents.postpicture AS img
    FROM contents 
    INNER JOIN categories ON categories.ID = contents.catID
    WHERE contents.status = '1' ".$felt."
    ORDER BY contents.date, categories.name DESC");

    $db->toGrid('title', 'category', 'short', 'date', 'img', 'contents_show');

?>