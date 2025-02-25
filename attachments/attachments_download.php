<?php
    $db->DBquery("SELECT * FROM attachments WHERE ID=".$id);
    
    $res = $db->fetchOne();
    $path = $res['dir'];
    $file = $path .'/'. $res['filename'];

    $db->fileDowload($file);
?>