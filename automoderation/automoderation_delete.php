<?php
$db->logincheck('uID');
    if (isset($_POST['yes']))
    {
        if ($_SESSION['uID'] != $id)
        {
            $db->DBquery("DELETE FROM automoderation WHERE ID=".$id);
        }
        header("location:index.php?pg=".base64_encode('automoderation_list'));
    }

    if (isset($_POST['no']))
    {
        header("location:index.php?pg=".base64_encode('automoderation_list'));
    }

    $db->toForm("name|Rekord törlése;
    action|automoderation_delete&id=".$id.";
    label|kerdes|Biztosan törlöd az alábbi moderációt?;
    submit|yes|Igen;
    submit|no|Mégsem");
    
    $db->DBquery("SELECT 
    ID AS 'Azonosító',
    word AS 'Tiltott szó'
    FROM automoderation 
    WHERE automoderation.ID=".$id);

    $db->showRecord();

?>