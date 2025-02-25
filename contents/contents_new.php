<?php
$db->logincheck('uID');
    if(isset($_POST['new']))
    {

        $catID = $_POST['categories'];
        $title = $db->escapeString($_POST['title']);
        $short = $db->escapeString($_POST['short']);
        $content = $db->escapeString($_POST['content']);
        $postpicture = $db->escapeString($_POST['postpicture']);

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
                $db->showMessage("Feltöltve", "success");
            }
            else
            {
                $db->showMessage("Hiba a feltöltés közben!", "danger");
            }
        }


        if(empty($catID) || empty($title) || empty($short) || empty($content))
        {
            $db->showMessage("Nem adtál meg minden adatot!", "danger");
        }
        else
        {
            $uid = $_SESSION['uID'];
            $db->DBquery("INSERT INTO contents VALUES(null, $catID, '$title', '$short', '$content', CURRENT_TIMESTAMP, '$filename', $uid, 1)");
        }
        header("location: index.php?pg=".base64_encode('contents_list'));
    }

    if(isset($_POST['back']))
    {
        header("location: index.php?pg=".base64_encode('contents_list'));
    }



    $db->toForm("name|Új tartalom felvétele;
    action|contents_new;
    label|x|Kategória:;
    select|categories|ID|name;
    label|x|Cím:;
    text|title|Add meg a címet;
    label|x|Rövid leírás:;
    textarea|short;
    label|x|Tartalom:;
    textarea|content||editor;
    label|x|Kép feltöltés:;
    file|fileToUpload|Tallózás;
    submit|new|Rekord felvétel;
    submit|back|Vissza a listához...");


?>