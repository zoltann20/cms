<?php
    $db->DBquery("SELECT 
    Felhasználók.ID AS '.ID',
    Felhasználók.name AS 'Felhasználónév',
    Felhasználók.email AS 'E-mail cím',
    rights.name AS 'Jogosultság',
    Felhasználók.reg AS 'Regisztráció',
    Felhasználók.last AS 'Ut.belépés',
    Felhasználók.status AS '.status'
    FROM users AS Felhasználók  
    INNER JOIN rights ON rights.ID = Felhasználók.rights");
    
    $db->toTable("s|i|u|d");
?>