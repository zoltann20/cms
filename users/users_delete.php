<?php
    if (isset($_POST['yes']))
    {
        if ($_SESSION['uID'] != $id)
        {
            $db->DBquery("DELETE FROM users WHERE ID=".$id);
        }
        header("location:index.php?pg=".base64_encode('users_list'));
    }

    if (isset($_POST['no']))
    {
        header("location:index.php?pg=".base64_encode('users_list'));
    }

    $db->toForm("name|Rekord törlése;
    action|users_delete&id=".$id.";
    label|kerdes|Biztosan törlöd az alábbi felhasználót?;
    submit|yes|Igen;
    submit|no|Mégsem");
    
    $db->DBquery("SELECT 
    users.ID AS 'Azonosító',
    users.name AS 'Felhasználónév',
    users.email AS 'E-mail cím',
    users.reg AS 'Regisztráció',
    users.last AS 'Ut.belépés',
    rights.name AS 'Jogosultság',
    users.status AS 'Státusz'
    FROM users 
    INNER JOIN rights ON rights.ID = users.rights
    WHERE users.ID=".$id);

    $db->showRecord();

?>