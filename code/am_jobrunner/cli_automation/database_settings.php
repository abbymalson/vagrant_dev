<?php

$dbSettings = array();
echo "hostname: " . gethostname() . "\n";
//switch (gethostname()) {
  //case "harry-potter":
if (gethostname() == 'harry-potter') {
    $server="localhost";
    $dbname="jobrunner";
    $user="root";
    $pass="WM41Discovery";
    $dbSettings['server'] = $server;
    $dbSettings['dbname'] = $dbname;
    $dbSettings['user'] = $user;
    $dbSettings['pass'] = $pass;
} else {
  //default:
    $server="localhost";
    $dbname="jobrunner";
    $user="root";
    $pass="easypeasy1";
    $dbSettings['server'] = $server;
    $dbSettings['dbname'] = $dbname;
    $dbSettings['user'] = $user;
    $dbSettings['pass'] = $pass;
}
 //   break;
//}

