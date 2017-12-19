<?php
// /usr/bin/php /vagrant/code/am_jobrunner/cli_job_runner/cli_job_runner.php

    $dbSettings = array();
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
// print_r($dbSettings);
// echo gethostname() . "\n";
