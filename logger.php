<?php

function curPageURL() {
    if ($_SERVER["SERVER_PORT"] == "443") {
        $pageURL = "https://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
 
function write_log($logfile='log.txt') {
    if( ($time = $_SERVER['REQUEST_TIME']) == '') {
        $time = time();
    }
    if( ($remote_addr = $_SERVER['REMOTE_ADDR']) == '') {
        $remote_addr = "REMOTE_ADDR_UNKNOWN";
    }
    $date = date("Y-m-d H:i:s", $time);
    if($fd = @fopen($logfile, "a")) {
        fputs($fd, "-------------\r\n");
        $result = fputcsv($fd, array($date, $remote_addr, curPageURL()));
        fputs($fd, "POST:");
        fputs($fd, print_r($_POST, true));
        fputs($fd, "GET:");
        fputs($fd, print_r($_GET, true));
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

write_log();

?>