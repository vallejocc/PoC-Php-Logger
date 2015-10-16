<?php

function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
 
function write_log($message, $logfile='log.txt') {
    if( ($time = $_SERVER['REQUEST_TIME']) == '') {
        $time = time();
    }
    if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
        $remote_addr = "REMOTE_ADDR_UNKNOWN";
    }
    $date = date("Y-m-d H:i:s", $time);
    if($fd = @fopen($logfile, "a")) {
        $result = fputcsv($fd, array($date, $remote_addr, curPageURL(), $message));
        fclose($fd);
    if($result > 0)
        return 'done';
    else
        return 'Unable to write to';
    }
    else {
        return 'Unable to open log!';
    }
}

write_log("-");

?>