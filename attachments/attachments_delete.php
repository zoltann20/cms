<?php
    $db->logincheck('uID');

    if(isset($_POST['yes']))
    {
        $db->DBquery("SELECT * FROM attachments WHERE ID=".$id);
        $res=$db->fetchOne();
        $contentID=$res['contentID'];

        if(is_file($res['dir'].'/'.$res['filename']))
        {
            unlink($res['dir'].'/'.$res['filename']);
        }

        $db->DBquery("DELETE FROM attachments WHERE ID=".$id);
        header("location: index.php?pg=".base64_encode('contents_attach&id='.$contentID));
    }

    $db->toForm('name|Csatolmány törlése;
    action|attachments_delete&id='.$id.';
    label|info|Biztosan törlöd?;
    submit|yes|Törlés');

    include("attachments_info.php");
?>