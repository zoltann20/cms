<?php
$db->logincheck('uID');
    if(isset($_POST['felvesz']))
    {
        $name = $db->escapeString($_POST['name']);
        if(empty($name))
        {
            $db->showMessage("Nem adtál meg nevet!", "danger");
        }
        else
        {
            $db->DBquery("SELECT * FROM categories WHERE name='$name'");
            if($db->numRows()!=0)
            {
                $db->showMessage("Van már ilyen nevű kategória");
            }
            else
            {
                $db->DBquery("INSERT INTO categories VALUES(null, '$name', 1)");
                header("location: index.php?pg=".base64_encode('categories_list'));
            }
        }
    }

    if(isset($_POST['back']))
    {
        header("location: index.php?pg=".base64_encode('categories_list'));
    }

    $db->toForm("name|Új kategória felvétele;
    action|categories_new;
    label|nev|A kategória neve:;
    text|name|Add meg a kategória nevét;
    submit|felvesz|Felvesz;
    submit|back|Vissza");
?>