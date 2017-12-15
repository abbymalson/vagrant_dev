<?php

$dbSettings = array();
echo "hostname: " . gethostname() . "\n";
switch (gethostname()) {
  case "harry-potter":
    $dbSettings['server'] = "localhost";
    $dbSettings['dbname'] = "jobrunner";
    $dbSettings['user'] = "root";
    $dbSettings['pass'] = "WM41Discovery";
    break;
  default:
    $dbSettings['server'] = "localhost";
    $dbSettings['dbname'] = "jobrunner";
    $dbSettings['user'] = "root";
    $dbSettings['pass'] = "easypeasy1";
    break;
}

