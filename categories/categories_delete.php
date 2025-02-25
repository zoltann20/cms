<?php
$db->logincheck('uID');
    if (isset($_POST['yes']))
    {
        if ($_SESSION['uID'] != $id)
        {
            $db->DBquery("DELETE FROM categories WHERE ID=".$id);
        }
        header("location:index.php?pg=".base64_encode('categories_list'));
    }

    if (isset($_POST['no']))
    {
        header("location:index.php?pg=".base64_encode('categories_list'));
    }

    $db->toForm("name|Rekord törlése;
    action|categories_delete&id=".$id.";
    label|kerdes|Biztosan törlöd az alábbi kategóriát?;
    submit|yes|Igen;
    submit|no|Mégsem");
    
    $db->DBquery("SELECT 
    ID AS 'Azonosító',
    name AS 'Kategória név',
    status AS 'Státusz'
    FROM categories 
    WHERE categories.ID=".$id);

    $db->showRecord();

?>