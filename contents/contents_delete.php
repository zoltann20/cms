<?php
$db->logincheck('uID');
    if (isset($_POST['yes']))
    {
        /*
        $db->DBquery("SELECT * FROM attachments WHERE contents.ID=".$id);
        foreach($db->queryresult AS $rekord)
        {
            if(is_file($rekord['dir'].'/'.$rekord['filename']))
            {
                unlink($rekord['dir'].'/'.$rekord['filename']);
            }
        }*/
        $db->DBquery("DELETE FROM attachments WHERE contentID=".$id);
        $db->DBquery("DELETE FROM comments WHERE contentID=".$id);       
        $db->DBquery("DELETE FROM contents WHERE ID=".$id); 
            
        header("location:index.php?pg=".base64_encode('contents_list'));   
    }


    if (isset($_POST['no']))
    {
        header("location:index.php?pg=".base64_encode('contents_list'));
    }

    $db->toForm("name|Rekord törlése;
    action|contents_delete&id=".$id.";
    label|kerdes|Biztosan törlöd az alábbi kategóriát?;
    submit|yes|Igen;
    submit|no|Mégsem");
    
    $db->DBquery("SELECT 
    ID AS 'Azonosító',
    title AS 'Cím',
    short AS 'Rövid tartalom',
    content AS 'Tartalom',
    postpicture AS 'Kép',
    date AS 'Dátum',
    status AS 'Státusz'
    FROM contents 
    WHERE contents.ID=".$id);

    $db->showRecord();

?>