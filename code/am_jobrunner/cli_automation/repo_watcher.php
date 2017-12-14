#! /usr/bin/php
<?php
$server="localhost";
// $dbname="";
$dbname="am_jobrunner";
$user="root";
$pass="WM41Discovery";


try {
	$dbh = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
  $repo = array();
  $repo['directory'] = "/home/vagrant/code/weedmaps/api";
  $repo['api_key'] = "47cf58e2329fe70446897e379adb72c69d37b20ca";
  $repo['status_url'] = "https://circle.weedmaps.com/gh/GhostGroup/weedmaps_api";
  // executeDockerCommand($dbh, 0);


} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
	$sth = null;
	$dbh = null;
  die();
}


function updateRepoInFileSystem($repo) {
  echo "changing into {$repo['directory']} directory ...  \n";
  chdir($repo['directory']);
  $ouptut = "";
  // git fetch; git pull;
  $output .= shell_exec('git fetch; git pull;');
  // git show-ref
  $showRef = shell_exec('git show-ref;');
    // capture output
    // loop over output
    // check for branch in array in database
    //if found, check branch SHA
    // if different, update branch sha info, update date, flag branch as updated
}

function checkBranchAgainstKnownBranches($branch) {

}

function updateBranchInKnownBranches($branch) {
}

function buildStatusPageImagesUrls($repo, $branchFriendlyName) {
  $style = "svg";
  switch ($style) {
  case "svg":
  default:
    $statusUrl = $repo['circle_status_url'] . $branchUrlFriendlyName . '.svg?style=svg&circle-token=' . $repo['circle_status_api_key'];
    break;
  }

  return $statusUrl;
}
