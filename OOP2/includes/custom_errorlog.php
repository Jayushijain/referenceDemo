<?php

function myErrorHandler($errno, $errstr, $errfile, $errline) 
{
    $message = "<b>Custom error:</b> [$errno] $errstr\n";
    $message .= " Error on line $errline in $errfile<br>\n";
    error_log($message, 3, "../../error_log.txt");
    exit();
}

set_error_handler("myErrorHandler");
?>