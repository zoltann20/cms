<?php
$db->logincheck('uID');
       if (isset($_POST['modosit']))
       {
            $nev = $_POST['name'];

            if (empty($nev))
            {
                $db->showMessage("Nem adtál meg minden adatot!", "danger");
            }
            else
            {
                     
                $db->DBquery("UPDATE categories SET name='$nev' WHERE ID=".$id);
                header("location: index.php?pg=".base64_encode('categories_list'));
                     
            }
       }

       $db->DBquery("SELECT * FROM categories WHERE ID=".$id);
       $res = $db->fetchOne();

       $db->toForm('name|Kategória módosítás;
       action|categories_update&id='.$id.';
       text|name||value="'.$res['name'].'";
       submit|modosit|Módosítás');

       echo '<button onClick="javascript:history.back();" class="btn btn-primary">Vissza...</button>';
?>