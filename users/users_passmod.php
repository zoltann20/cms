<?php
    if (isset($_POST['mod']))
    {
        $oldpass = $db->escapeString($_POST['oldpass']);
        $newpass1 = $db->escapeString($_POST['newpass1']);
        $newpass2 = $db->escapeString($_POST['newpass2']);
        if (empty($oldpass) || empty($newpass1) || empty($newpass2))
        {
            $db->showMessage('Nem adtál meg minden adatot!', 'danger');
        }
        else
        {
            if ($newpass1 != $newpass2)
            {
                $db->showMessage('A megadott új jelszavak nem egyeznek!', 'danger');
            }
            else
            {
                $db->DBquery("SELECT password FROM users WHERE ID=".$_SESSION['uID']);
                $user = $db->fetchOne();
                if ($user['password'] != SHA1($oldpass))
                {
                    $db->showMessage('Nem megfelelő a jelenlegi jelszó!', 'danger');
                }
                else
                {
                    $newpass1 = SHA1($newpass1);
                    $db->DBquery("UPDATE users SET password='$newpass1' WHERE ID=".$_SESSION['uID']);
                    $db->showMessage('A jelszó megváltozott!', 'success');
                }
            }
        }
    }
    $db->toForm('name|Jelszó módosítás;
    action|users_passmod;
    password|oldpass|Jelenlegi jelszó;
    password|newpass1|Új jelszó;
    password|newpass2|Új jelszó megerősítése;
    submit|mod|Módosítás');
?>