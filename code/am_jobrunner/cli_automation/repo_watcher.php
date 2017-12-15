#! /usr/bin/php
<?php

$dbSettings = array();
switch (gethostname()) {
  case "harry-potter":
    $dbSettings['server'] = "localhost";
    $dbSettings['dbname'] = "jobrunner";
    $dbSettings['user'] = "root";
    $dbSettings['pass'] = "WM41Discovery";
  default:
    $dbSettings['server'] = "localhost";
    $dbSettings['dbname'] = "jobrunner";
    $dbSettings['user'] = "root";
    $dbSettings['pass'] = "easypeasy1";
    break;
}

try {
	$dbh = new PDO("mysql:host={$dbSettings['server']};dbname={$dbSettings['dbname']}", $dbSettings['user'], $dbSettings['pass']);
  // pull data from the database
  // get the repo information
  // get the sha information for the given repository
  $repo = array();
  $repo['directory'] = "/home/vagrant/code/weedmaps/api";
  $repo['api_key'] = "47cf58e2329fe70446897e379adb72c69d37b20ca";
  $repo['status_url'] = "https://circle.weedmaps.com/gh/GhostGroup/weedmaps_api";
  // executeDockerCommand($dbh, 0);

  $gitRepoBranchInformation = updateRepoInFileSystem($repo);
    // check for branch in array in database
    //if found, check branch SHA
    // if different, update branch sha info, update date, flag branch as updated
    // if branch not present in database array, flag for insert into the database

} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
	$sth = null;
	$dbh = null;
  die();
}


function updateRepoInFileSystem($repo) {
  echo "changing into {$repo['directory']} directory ...  \n";
  chdir($repo['directory']);
  $output = "";
  // git fetch; git pull;
  $output .= shell_exec('git fetch; git pull;');
  // git show-ref
    // capture output
  $showRef = shell_exec('git show-ref;');
  echo $output;
  echo $showRef;
    // loop over output
  $data = parseDataFromShowRef($showRef);
  print_r($data);
}

function parseDataFromShowRef($showRef) {

  $data = array();
  // read in line
  $splitNl = preg_split("/\n/", $showRef);
  // split line on whitespace
  foreach($splitNl as $line) {
    if ($line != "") {
      $splitStr = preg_split("/ /", $line);
      $data[] = $splitStr;
    }
  }
  return $data;
}

function getBranchDataFromDatabase($branch) {

}


function checkBranchAgainstKnownBranches($branch) {

}

function updateBranchInKnownBranches($branch) {
}

function buildStatusPageImagesUrls($repo, $branchUrlFriendlyName) {
  $style = "svg";
  switch ($style) {
  case "svg":
  default:
    $statusUrl = $repo['circle_status_url'] . $branchUrlFriendlyName . '.svg?style=svg&circle-token=' . $repo['circle_status_api_key'];
    break;
  }

  return $statusUrl;
}
