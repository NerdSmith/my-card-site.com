<?php

$menu = array(
    '1' => array("name" => "Hello, wayfarer", "page" => "./"),
    '2' => array("name" => "Projects", "page" => "./projects"),
    '3' => array("name" => "Contacts", "page" => "./contacts"),
    '4' => array("name" => "About", "page" => "./about"),
    '5' => array("name" => "Comments", "page" => "./comments"),
);

class load_page_vars {
    function title(){

        global $menu;
        $item = $menu;

        $str = '';
        $i=0;
        foreach($item as $k => $value)
        {
            $i++;
            if($item[$i]["page"] == ".".$this->state())
            {
                return $item[$i]["name"];
            }        
        }
    }

    function menu(){

        global $menu;

        $str = '<div class="Content">';
        
        $i=0;
        foreach($menu as $k => $value)
        {
            $i++;
            if ($i == 1) {
                //$str .= "<a href='./' ".('./' == ".".$this->state() ? 'class="selected"' : '')." title='Hello, wayfarer' id='logo'>"."<img id='logo_img' src='imgs/logo.svg' />"."</a>";
                $str.= "<a id='logo' href='".$menu[$i]["page"]."' ".($menu[$i]["page"] == ".".$this->state() ? 'class="selected"' : '')." title='".$menu[$i]["name"]."'>"."<img id='logo_img' src='imgs/logo.svg' />"."</a>";
                $str .= '<div id="nav">';
            }
            else {
                $str.= "<a href='".$menu[$i]["page"]."' ".($menu[$i]["page"] == ".".$this->state() ? 'class="selected"' : '')." title='".$menu[$i]["name"]."'>".$menu[$i]["name"]."</a>";
                if ($i != sizeof($menu)) {
                    $str.= "<div>|</div>";
                }
            }
        }
        $str .= '</div>';
        $str .= '</div>';
        //$this->state($page_title);
        return $str;
    }



    function content($page, $name){

        $post = array(
            'page' => ".".$page,
            'name' => $name,
            'password' => 'bar',
            'submit' => TRUE,
        );
         
        $data = http_build_query($post);

        $opts = array(
                  'http' => array(
                      'method' => 'POST',
                      'header' => "Content-type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($data) . "\r\n",
                      'content' => $data,
                  )
               );

        $context  = stream_context_create($opts);

        $url = $this->siteURL()."/content.php";
        $content = file_get_contents($url,FALSE,$context);

        return $content;
    }

    function state() {
        $request = substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
        $str_repl = str_replace($request, '', $_SERVER['REQUEST_URI']);
        return $str_repl;
    }

    function siteURL()
    {
        if (isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
          $protocol = 'https://';
        }
        else {
          $protocol = 'http://';
        }

        $siteUrl = $protocol.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];

        return dirname($siteUrl);

    }

}

$data = new load_page_vars();

?>