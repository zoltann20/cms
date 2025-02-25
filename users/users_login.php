<?php 
    // ha létezik a süti, akkor létrehozzuk a munkamenet változókat
    if (isset($_COOKIE['uid']) && !isset($_SESSION['uID']))
    {
        $_SESSION['uID'] = $_COOKIE['uid'];
        $_SESSION['uname'] = $_COOKIE['uname'];
        $_SESSION['umail'] = $_COOKIE['umail'];
        $_SESSION['ureg'] = $_COOKIE['ureg'];
        $_SESSION['ulast'] = $_COOKIE['ulast'];
        $_SESSION['urights'] = $_COOKIE['urights'];
    }

    if (!isset($_SESSION['uID']))
    {
        // ha rákattintottunk a belépés gombra
        if (isset($_POST['login']))
        {
            $email = $db->escapeString($_POST['email']);
            $pass = $db->escapeString($_POST['pass']);
            if (empty($email) || empty($pass))
            {
                $db->showMessage('Nem adtál meg minden adatot!','danger');
            }
            else
            {
                $db->DBquery("SELECT * FROM users WHERE email='$email'");
                if ($db->numRows() == 0)
                {
                    $db->showMessage('Nem regisztrált e-mail cím!','danger');
                }
                else
                {
                    $res = $db->fetchOne();
                    if ($res['password'] != SHA1($pass))
                    {
                        $db->showMessage('Hibás jelszó!','danger');
                    }
                    else
                    {
                        if ($res['status'] == 0)
                        {
                            $db->showMessage("Ez a felhasználó tiltott!", "danger");
                        }
                        else
                        {
                            $db->DBquery("UPDATE users SET last=CURRENT_TIMESTAMP WHERE ID=".$res['ID']);
                       
                            $db->DBquery("SELECT * FROM users WHERE email='$email'");
                            $res = $db->fetchOne();
    
                            $_SESSION['uID'] = $res['ID'];
                            $_SESSION['uname'] = $res['name'];
                            $_SESSION['umail'] = $res['email'];
                            $_SESSION['ureg'] = $res['reg'];
                            $_SESSION['ulast'] = $res['last'];
                            $_SESSION['urights'] = $res['rights'];
    
                            // ha bepipáltuk a bejelentkezve maradok-ot
                            if (isset($_POST['rememberme']))
                            {
                                // létrehozzuk a sütiket a munkamenet változók alapján (30 napra)
                                setcookie('uid', $_SESSION['uID'], time() + (86400 * 30), '/');
                                setcookie('uname', $_SESSION['uname'], time() + (86400 * 30), '/');
                                setcookie('umail', $_SESSION['umail'], time() + (86400 * 30), '/');
                                setcookie('ureg', $_SESSION['ureg'], time() + (86400 * 30), '/');
                                setcookie('ulast', $_SESSION['ulast'], time() + (86400 * 30), '/');
                                setcookie('urights', $_SESSION['urights'], time() + (86400 * 30), '/');
                            }                                                
                            header('location:index.php');  
                        }
                    }
                }
            }
        }

        

        // legeneráljuk a bejelentkezés űrlapot 
        $db->toForm('action|index
        ;name|Belépés
        ;email|email|E-mail cím
        ;password|pass|Jelszó
        ;checkbox|rememberme|Bejelentkezve maradok
        ;submit|login|Belépek');
    }
    else
    {
        if (isset($_POST['logout']))
        {
            // ha létezik sütink
            if (isset($_COOKIE['uid']))
            {
                // meszüntetjük a sütiket
                unset($_COOKIE['uid']); 
                unset($_COOKIE['uname']);
                unset($_COOKIE['umail']);
                unset($_COOKIE['ureg']);
                unset($_COOKIE['ulast']);
                unset($_COOKIE['urights']);
    
                setcookie('uid', '', time() - 3600, '/'); 
                setcookie('uname', '', time() - 3600, '/'); 
                setcookie('umail', '', time() - 3600, '/');
                setcookie('ureg', '', time() - 3600, '/');
                setcookie('ulast', '', time() - 3600, '/');
                setcookie('urights', '', time() - 3600, '/');
            }
            unset($_SESSION['uID']);
            unset($_SESSION['uname']);
            unset($_SESSION['umail']);
            unset($_SESSION['ureg']);
            unset($_SESSION['ulast']);
            unset($_SESSION['urights']);

            header('location:index.php');
        }
        $db->toForm('name|Belépve
        ;action|index
        ;label|uname|'.$_SESSION['uname'].'
        ;label|umail|'.$_SESSION['umail'].'
        ;label|ulast|bejelentkezés időpontja:<br>'.$_SESSION['ulast'].'
        ;submit|logout|Kilépés');
        include('menu.php');
    }
?>