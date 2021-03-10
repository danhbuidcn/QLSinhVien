<?php
    if(isset($_GET['mnu'])){
        $menu_id = @$_GET["mnu"];
        $url="../".$menu_id;
        require("$url");
    }
?>