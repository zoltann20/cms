<?php
    $db->DBquery("SELECT * FROM menu ORDER BY queue ASC");
    
    echo '<ul class="nav flex-column">';

    $i = 0;
    foreach($db->queryresult as $menuitem)
    {
        if ($i % 2 == 0)
        {
            $anim = "slideInLeft";
        }
        else
        {
            $anim = "slideInRight";
        }
        $i++;
        echo '<li class="nav-item animated faster '.$anim.'">
            <a href="index.php?pg='.base64_encode($menuitem['param']).'" class="nav-link">
            <svg class="bi" width="16" height="16" fill="currentColor">
                <use xlink:href="icons/bootstrap-icons.svg#'.$menuitem['icon'].'"/>
            </svg>&nbsp;
            '.$menuitem['name'].'</a>
        </li>';
    }
    
    echo '</ul>';
?>

