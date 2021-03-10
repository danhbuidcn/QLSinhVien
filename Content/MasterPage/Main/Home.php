<?php require("../HandlerSession.php");
    // handler exception
    require("../HandlerException.php");
?>
<DOCTYPE !html>
<html>
<header>
    <?php require("UrlHeader.php");?>  
</header>
<body>
    <div class="container-fluid" style="padding:0;position:relative;">
        <div id="head">
            <?php 
                require("Header.php");
            ?> 
        </div>
        <div id="body">
            <div id="wapper" class="dropdown">
                <div id="navigation">
                    <?php require("Menu.php");?>
                </div>
                <div id="content">
                    <?php require("Container.php");?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".display-click").click(function(){
                $(this).find("ul").toggle();
            });
            $("#navList").find("a").click(function(){
                $("#navigation").find(".list-group").toggle();
            }); 
        });
    </script>
</body>
</html>