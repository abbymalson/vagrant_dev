#! /usr/bin/php
<?php

require_once "database_settings.php";
require_once "class.database.php";
require_once "class.parameter.php";
echo "hostname: " . gethostname() . "\n";
switch (gethostname()) {
  case "harry-potter":
  $repo = array();
  $repo['directory'] = "/home/weedmaps/code/weedmaps/api";
  $repo['api_key'] = "47cf58e2329fe70446897e379adb72c69d37b20ca";
  $repo['status_url'] = "https://circle.weedmaps.com/gh/GhostGroup/weedmaps_api";
    break;
  default:
  $repo = array();
  $repo['directory'] = "/home/vagrant/code/weedmaps/api";
  $repo['api_key'] = "47cf58e2329fe70446897e379adb72c69d37b20ca";
  $repo['status_url'] = "https://circle.weedmaps.com/gh/GhostGroup/weedmaps_api";
    break;
}

try {
  print_r($dbSettings);
	$dbh = new PDO("mysql:host={$dbSettings['server']};dbname={$dbSettings['dbname']}", $dbSettings['user'], $dbSettings['pass']);

  $dbhMySql = new MysqlObj($dbSettings['server'], $dbSettings['dbname'], $dbSettings['user'], $dbSettings['pass']);
  // pull data from the database
  $repoInformation = getRepoInfoInDb($dbh);
  // based on the parameters from the job, we'll know to pull the correct repo

  // get the repo information
  // get the sha information for the given repository
  // executeDockerCommand($dbh, 0);

  $gitRepoBranchInformation = updateRepoInFileSystem($dbhMySql, $repo);
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

function getRepoInfoInDb($databaseHandler) {
  try {
    // get information from the database
    // SQL:
    // SELECT
    //   repo.repository_id,
    //   repo.repository_name,
    //   repo.local_directory_path,
    //   repo.github_path,
    //   repo.github_clone_path,
    //   repo.circle_status_api_key,
    //   repo.circle_status_url
    // FROM
    //   tbl_ghd_repository repo
    // WHERE
    //   repo.active = 'Y'
    $sql = "
      SELECT 
        repo.repository_id,
        repo.repository_name,
        repo.local_directory_path,
        repo.github_path,
        repo.github_clone_path,
        repo.circle_status_api_key,
        repo.circle_status_url
      FROM
        tbl_ghd_repository repo
      WHERE
        repo.active = 'Y'";
    $result = $databaseHandler->query($sql);
    if ($result) {
      foreach ($result as $row) {
        echo "repo: ";
        print_r($row);
//               echo "starting job: " . $row['friendly_name'] . " (" . $row['date_job_submitted'] . ")\n";
  //            $output = shell_exec($row['absolute_path_to_execute_job']);
   //       echo "\n";
    //      echo "OUTPUT\n";
    //      echo "=========================\n";
    //      echo $output . "\n";
        } 
    }

  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    $sth = null;
    $databaseHandler= null;
  }


}

/*
function executeSql($dbh, $sql, $parameters) {
  try {
    $sth = $dbh->prepare($sql);

    $sth = buildParametersForSql($sth, $parameters);

  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    $sth = null;
    $dbh = null;
    die();
  }
}

function buildParametersForSql($sth, $jsonParemters) {

  return $sth;

}
 */
function updateRepoInFileSystem($databaseHandler, $repo) {
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
  foreach ($data as $row) {
    updateBranchInformationInDatabase($databaseHandler, $repo,  $row[0], $row[1]); // SHA, branch
  }

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


function updateBranchInformationInDatabase($dbh, $repo, $sha, $branch) {
  $sql = "INSERT INTO (
      repository_id,
      sha_value, 
      branch_name
    ) VALUES (
      :repository_id,
      :sha,
      :branch
    )
      ON DUPLICATE KEY
    UPDATE
      sha_value = :sha
    ";
  $parameters = array();
  // $parameters[] = new Parameter(type, name, value);
  $parameters[] = new Parameter("integer", "repository_id", $repo['repository_id']);
  $parameters[] = new Parameter("string", "sha", $sha);
  $parameters[] = new Parameter("string", "branch", $branch);
  // echo $sql;
  $dbh->executeSql($dbh, $sql, $parameters) ;
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
