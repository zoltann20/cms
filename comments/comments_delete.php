<?php
    $db->logincheck('uID');
    $db->DBquery("DELETE FROM comments WHERE ID=".$id);
    $contentID = $_SESSION['contentID'];
    unset($_SESSION['contentID']);
    header("location: index.php?pg=".base64_encode('contents_show&id='.$contentID));
?>