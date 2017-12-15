<?php
// /usr/bin/php /vagrant/code/am_jobrunner/cli_job_runner/cli_job_runner.php

    $dbSettings = array();
switch (gethostname()) {
  case "harry-potter":
    $server="localhost";
    $dbname="am_jobrunner";
    $user="root";
    $pass="WM41Discovery";
    $dbSettings['server'] = $server;
    $dbSettings['dbname'] = $dbname;
    $dbSettings['user'] = $user;
    $dbSettings['pass'] = $pass;
  default:
    $server="localhost";
    $dbname="am_jobrunner";
    $user="root";
    $pass="easypeasy1";
    $dbSettings['server'] = $server;
    $dbSettings['dbname'] = $dbname;
    $dbSettings['user'] = $user;
    $dbSettings['pass'] = $pass;
    break;
}
