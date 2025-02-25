<?php
    $pg = @base64_decode($_GET['pg']);
    $url = array();
    $url = explode('&', $pg);
    if (empty($url[0]))
    {
        include($default_page.'.php');
    }
    else
    {
        if (isset($url[1])) 
        {
            $param = explode('=', $url[1]);
            $id = $param[1];
        }

        if (is_file($url[0].'.php'))
        {
          include($url[0].'.php');
        }
        else
        {
          $dir = substr($url[0], 0, strpos($url[0], '_'));
          include($dir.'/'.$url[0].'.php');
        }
    }
?>