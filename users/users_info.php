<?php
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