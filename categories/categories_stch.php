<?php
$db->logincheck('uID');
    if ($_SESSION['uID'] != $id)
    {
        $db->DBquery("UPDATE categories SET status = not status WHERE ID=".$id);
    }
    header("location: index.php?pg=".base64_encode('categories_list'));
?>