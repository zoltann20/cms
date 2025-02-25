<?php
    if (isset($_POST['mod']))
    {
        $name = $db->escapeString($_POST['name']);
        $email = $db->escapeString($_POST['email']);
        $ujnev = true;
        $ujemail = true;
        if (empty($name))
        {
            $name = $_SESSION['uname'];
            $ujnev = false;
        }
        if (empty($email))
        {
            $email = $_SESSION['umail'];
            $ujemail = false;
        }
        $db->DBquery("SELECT * FROM users WHERE email='$email' AND ID<>".$_SESSION['uID']);
        if ($db->numRows() != 0)
        {
            $db->showMessage('Ez az e-mail cím már foglalt!', 'danger');
        }
        else
        {
            if ($ujnev || $ujemail)
            {
                $db->DBquery("UPDATE users SET name='$name', email='$email' WHERE ID=".$_SESSION['uID']);
                $_SESSION['uname'] = $name;
                $_SESSION['umail'] = $email;
                $db->showMessage("Az adatok módosultak!", 'success');
            }
            else
            {
                $db->showMessage("Nem változott semmi!", 'info');
            }
        }
    }
    $db->DBquery("SELECT name FROM rights WHERE ID=".$_SESSION['urights']);
    $res = $db->fetchOne();

    $db->toForm('name|Adatmódosítás;
    action|users_profilmod;
    text|name|'.$_SESSION['uname'].';
    email|email|'.$_SESSION['umail'].';
    label|jog|Jogosultság:;
    text|jog|'.$res['name'].'|disabled;
    label|reg|Regisztráció dátuma:;
    text|reg|'.$_SESSION['ureg'].'|disabled;
    label|last|Utolsó belépés dátuma:;
    text|last|'.$_SESSION['ulast'].'|disabled;
    submit|mod|Módosítás');
?>