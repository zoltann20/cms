<?php

    include('comments/comments_new.php');

    $db->DBquery("SELECT * FROM automoderation");
    $words = $db->fetchAll();

    $db->DBquery("SELECT
    comments.ID AS 'ID',
    comments.userID AS 'userID',
    comments.date AS 'date',
    comments.comment AS 'comment',
    users.name AS 'username'
    FROM comments 
    INNER JOIN users ON users.ID = comments.userID
    WHERE comments.contentID=".$id."
    ORDER BY date DESC");
    
    echo '<h5>Hozzászólások:</h5><hr>';

    if($db->numRows() == 0)
    {
        echo 'Még nincs hozzászólás';
    }
    else
    {
        $_SESSION['contentID'] = $id;
        foreach($db->queryresult as $rekord)
        {
            echo '<div class="card col-12">
                <div class="card-header row">
                    <div class="col-6 font-weight-bold">
                        '.$rekord['username'].'
                    </div>
                    <div class="col-6 text-muted text-right">
                        '.$rekord['date'];
                        if(isset($_SESSION['uID']))
                        {
                            if(($_SESSION['urights'] == 1) || ($rekord['userID'] == $_SESSION['uID']))
                            {  
                                echo '
                                &nbsp;&nbsp;
                                <a href="index.php?pg='.base64_encode('comments_delete&id='.$rekord['ID']).'" class="close">
                                    <span aria-hidden="true">&times;</span>
                                </a>';
                            }
                        }
                        echo'
                    </div>
                </div>
                <div class="card-body text-justify">
                    '.$db->moderate($rekord['comment'], $words).'
                </div>
            </div>';

            $rekord['username'];
            $rekord['date'];
            $rekord['comment'];
        }
    }
?>