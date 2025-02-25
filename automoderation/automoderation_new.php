<?php
$db->logincheck('uID');
    if(isset($_POST['felvesz']))
    {
        $word = $db->escapeString($_POST['word']);
        if(empty($word))
        {
            $db->showMessage("Nem adtál meg moderációt!", "danger");
        }
        else
        {
            $db->DBquery("SELECT * FROM automoderation WHERE word='$word'");
            if($db->numRows()!=0)
            {
                $db->showMessage("Van már ilyen moderáció");
            }
            else
            {
                $db->DBquery("INSERT INTO automoderation VALUES(null, '$word')");
                header("location: index.php?pg=".base64_encode('automoderation_list'));
            }
        }
    }

    if(isset($_POST['back']))
    {
        header("location: index.php?pg=".base64_encode('automoderation_list'));
    }

    $db->toForm("name|Új moderáció felvétele;
    action|automoderation_new;
    label|nev|A moderáció:;
    text|word|Add meg a a moderálni kívánt szót;
    submit|felvesz|Felvesz;
    submit|back|Vissza");
?>