<?php

$servername = "yoda.media.h-da.de";
$username = "pwws17_01";
$password = "PeTaZaLe=45";
$dbname = "pwws17db01";

/*
$servername = "localhost";
$username = "root";
$dbname = "pwws17db01";
*/
$Connection= @ mysql_connect ($servername, $username, $password, $dbname);
$ConnectingDB= @ mysql_select_db ($dbname,$Connection);



?>