<?php
// /usr/bin/php /vagrant/code/am_jobrunner/cli_job_runner/start_selenium.php


echo "hello from cli_job_runner \n";
$server="localhost";
$dbname="am_jobrunner";
$user="root";
$pass="easypeasy1";
$IDLE_COUNTER = 50;
$boredomCounter = 50;
$display=1;

// Order
// Start vncserver
// pass in display port
 // export display port
system("export DISPLAY=:$display");
system(' /opt/java/bin/java  -jar /opt/selenium-server.jar  ');