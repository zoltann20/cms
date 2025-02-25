<?php
    $db->DBquery("SELECT
    contents.title AS title,
    contents.date as date,
    contents.postpicture AS img,
    contents.short AS short,
    contents.content AS content,
    users.name AS name
    FROM contents
    INNER JOIN users ON users.ID = contents.userID WHERE contents.ID=".$id);
    $res = $db->fetchOne();

    echo '<h3>'.$res['title'].'</h3>
    <hr>
    <div class="contentimage">
        <p class="text-muted">'.$res['date'].' - '.$res['name'].'</p>
        <p><img src="../cms/files/'.$res['img'].'" alt="'.$res['img'].'"></p>
        <p class="text-justify">'.$res['short'].'</p>
        <p>'.nl2br($res['content']).'</p>
    </div>';

    include("attachments/attachments_list.php");
    include("comments/comments_list.php");
?>