<?php 
    ini_set('display_errors','off');
    ini_set('log_errors','on');
    ini_set('error_log','/StudentApplication/handlerError.txt');
    error_reporting(0);

    function MyError($error_level,$error_message,$error_file,$error_line){
        print_r($error_message);
        $result='Error number : '.$error_level.', error message : '.$error_message.', error file :'.$error_file.', error line : '.$error_line;
        $fp = fopen('/StudentApplication/handlerError.txt', 'w');
        fputs($fp, $result. "\n");
        fclose($fp);
        echo("<script>window.location.replace('/StudentApplication/Error.php');</script>");
        die($result);
    }
    set_error_handler('MyError');
?>