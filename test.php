<?php
$log = fopen('test.txt', 'a+');
fputs($log, "--------------------------------------------------------------------------------------------\r\n");
fputs($log, "\r\n");

fputs($log, 'IPN re�u le '.date('d/m/y � G:i:s'));fputs($log, "\r\n");
fputs($log, 'Origine: shares ou donation');fputs($log, "\r\n");

?>