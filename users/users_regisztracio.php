<?php
    if (isset($_POST['regisztracio']))
    {
        // inputok védelme
        $teljesnev = $db->escapeString($_POST['name']);
        $email = $db->escapeString($_POST['email']);
        $pass1 = $db->escapeString($_POST['pass1']);
        $pass2 = $db->escapeString($_POST['pass2']);

        if (empty($teljesnev) || empty($email) || empty($pass1) || empty($pass2))
        {
            $db->showMessage('Nem adtál meg minden adatot!', 'danger');
        }
        else
        {
            if ($pass1 != $pass2)
            {
                $db->showMessage('A megadott jelszavak nem egyeznek!', 'danger');
            }
            else
            {
                $db->DBquery("SELECT * FROM users WHERE email='$email'");
                if ($db->numRows() != 0)
                {
                    $db->showMessage('Ez az e-mail cím már foglalt!', 'danger');
                }
                else
                {
                    if (!isset($_POST['regfelt']))
                    {
                        $db->showMessage('Nem fogadtad el a regisztrációs szabályzatot!', 'danger');
                    }
                    else
                    {
                        $pass1 = SHA1($pass1);
                        $db->DBquery("INSERT INTO users VALUES(null, '$teljesnev', '$email', '$pass1', CURRENT_TIMESTAMP, null, 2, 1)");
                        $db->showMessage('Sikeres regisztráció!', 'success');
                    }
                }
            }
        }
    }


    $db->toForm('name|Regisztráció;
    action|users_regisztracio;
    text|name|Teljes név;
    email|email|E-mail cím;
    password|pass1|Jelszó;
    password|pass2|Jelszó megerősítése;
    checkbox|regfelt|A regisztrációs szabályzatot elfogadom;
    submit|regisztracio|Regisztráció');
?>  