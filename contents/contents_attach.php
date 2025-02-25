<?php
$db->logincheck('uID');

if(isset($_POST['upload']))
{
    $filename = $_FILES['fileToUpload']['name'];

    if(isset($filename))
    {
        $tmp_name = $_FILES['fileToUpload']['tmp_name'];
        if(!is_dir($uploads_dir))
        {
            mkdir($uploads_dir);
        }
        if(move_uploaded_file($tmp_name, $uploads_dir."/".$filename))
        {
            $filesize = $_FILES['fileToUpload']['size'];
            $filetype = $_FILES['fileToUpload']['type'];
            $uid = $_SESSION['uID'];
            $db->DBquery("INSERT INTO attachments VALUES(null, $id, $uid, '$uploads_dir', '$filename', $filesize, '$filetype', CURRENT_TIMESTAMP)");
            $db->showMessage("A feltöltés sikeres!", "success");
        }
        else
        {
            $db->showMessage("Hiba a feltöltés közben!", "danger");
        }
    }
}

if(isset($_POST['back']))
    {
        header("location: index.php?pg=".base64_encode('contents_list'));
    }

$db->toForm('name|Új csatolmány feltöltése;
action|contents_attach&id='.$id.';
label|x|Add meg a csatolni kívánt fájlt:;
file|fileToUpload|Tallózás;
submit|upload|Feltöltés;
submit|back|Vissza');

    $db->DBquery("SELECT 
        ID AS '.ID',
        contentID AS '.contentID',
        userID AS '.userID',
        dir AS '.dir',
        filename AS 'Fájlnév',
        size AS 'Méret',
        type AS 'Típus',
        date AS 'Dátum'
        FROM attachments AS Csatolmányok WHERE contentID=".$id);
   
   $db->toTable('c|i|d');
?>