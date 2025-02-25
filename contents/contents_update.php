<?php
$db->logincheck('uID');
       if (isset($_POST['modosit']))
       {
            $title = $_POST['title'];
            $short = $_POST['short'];
            $content = $_POST['content'];

            if (empty($title) || empty($short) || empty($content))
            {
                $db->showMessage("Nem adtál meg minden adatot!", "danger");
            }
            else
            {
                     
                $db->DBquery("UPDATE contents SET title='$title', short ='$short', content='$content' WHERE ID=".$id);
                header("location: index.php?pg=".base64_encode('contents_list'));
                     
            }
       }

       $db->DBquery("SELECT * FROM contents WHERE ID=".$id);
       $res = $db->fetchOne();

       $db->toForm('name|Tartalom módosítás;
       action|contents_update&id='.$id.';
       text|title||value="'.$res['title'].'";
       text|short||value="'.$res['short'].'";
       text|content||value="'.$res['content'].'";
       submit|modosit|Módosítás');

       echo '<button onClick="javascript:history.back();" class="btn btn-primary">Vissza...</button>';
?>