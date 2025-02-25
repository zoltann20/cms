<?php
$db->logincheck('uID');
       if (isset($_POST['modosit']))
       {
            $word = $_POST['word'];

            if (empty($word))
            {
                $db->showMessage("Nem adat meg a módosítani kívánt tiltott szót!", "danger");
            }
            else
            {
                     
                $db->DBquery("UPDATE automoderation SET word='$word' WHERE ID=".$id);
                header("location: index.php?pg=".base64_encode('automoderation_list'));
                     
            }
       }

       $db->DBquery("SELECT * FROM automoderation WHERE ID=".$id);
       $res = $db->fetchOne();

       $db->toForm('name|Moderáció módosítás;
       action|automoderation_update&id='.$id.';
       text|word||value="'.$res['word'].'";
       submit|modosit|Módosítás');

       echo '<button onClick="javascript:history.back();" class="btn btn-primary">Vissza...</button>';
?>