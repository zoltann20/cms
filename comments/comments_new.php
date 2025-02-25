<?php
    if(isset($_SESSION['uID']))
    {
        if(isset($_POST['send']))
        {
            $comment = $db->escapeString($_POST['comment']);
            if (empty($comment))
            {
                $db->showMessage("Nem írtál semmit!","danger");
            }
            else
            {
                $uid = $_SESSION['uID'];
                $db->DBquery("INSERT INTO comments VALUES(null, $id, $uid, CURRENT_TIMESTAMP, '$comment')");
                unset($_POST['comment']);
                unset($_POST['send']);

            }
        }
        $db->toForm('name|Hozzászólás írása;
        action|contents_show&id='.$id.';
        textarea|comment;
        submit|send|Elküldés');
    }
?>