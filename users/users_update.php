<?php
       if (isset($_POST['modosit']))
       {
              $nev = $_POST['name'];
              $email = $_POST['email'];
              $rights = $_POST['rights'];

              if (empty($nev) || empty($email) || empty($rights)) // EZ MÉG NEM JÓ
              {
                     $db->showMessage("Nem adtál meg minden adatot!", "danger");
              }
              else
              {
                     $db->DBquery("SELECT * FROM users WHERE email='$email' AND ID<>".$id);
                     if ($db->numRows() != 0)
                     {
                            $db->showMessage("Ez az e-mail cím már foglalt!", "danger");
                     }
                     else
                     {
                            $db->DBquery("UPDATE users SET name='$nev', email='$email', rights=$rights WHERE ID=".$id);
                            header("location: index.php?pg=".base64_encode('users_list'));
                     }
              }
       }

       $db->DBquery("SELECT * FROM users WHERE ID=".$id);
       $res = $db->fetchOne();

       $db->toForm('name|Felhasználó módosítás;
       action|users_update&id='.$id.';
       text|name||value="'.$res['name'].'";
       email|email||value="'.$res['email'].'";
       select|rights|ID|name|'.$res['rights'].';
       label|reg|Regisztráció dátuma:;
       text|reg|'.$res['reg'].'|disabled;
       label|last|Utolsó belépés dátuma:;
       text|last|'.$res['last'].'|disabled;
       submit|modosit|Módosítás');

       echo '<button onClick="javascript:history.back();" class="btn btn-primary">Vissza...</button>';
?>