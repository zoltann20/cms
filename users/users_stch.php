<?php
    if ($_SESSION['uID'] != $id)
    {
        $db->DBquery("UPDATE users SET status = not status WHERE ID=".$id);
    }
    header("location: index.php?pg=".base64_encode('users_list'));
?>