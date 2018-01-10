#! /usr/bin/php
<?php

// DEFINE CONSTANTS
CONST BRANCH_FOUND_IN_DATABASE_DIFFERENT_SHA_VALUE      = 10;
CONST BRANCH_FOUND_IN_DATABASE_SAME_SHA_VALUE           = 20;
CONST BRANCH_NOT_FOUND_IN_DATABASE                      = 30;

require_once "database_settings.php";
require_once "class.database.php";
require_once "class.parameter.php";
        

foreach ($argv as $arg) {
  $e=explode("=",$arg);
  if(count($e)==2)
    $_GET[$e[0]]=$e[1];
  else    
    $_GET[]=$e[0];
}

echo "_GET:";
var_dump($_GET);
echo "\n";
echo "hostname: " . gethostname() . "\n";
switch ($_GET[1]) {
  case "api":
  default:
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/api";
    $repo['repository_id'] = 1;
    $repo['active'] = true;
    break;
  case "core":
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/core";
    $repo['repository_id'] = 2;
    $repo['active'] = false;
    break;
  case "ionic":
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/ionic";
    $repo['repository_id'] = 3;
    $repo['active'] = false;
    break;
  case "moonshot":
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/moonshot";
    $repo['repository_id'] = 4;
    $repo['active'] = false;
    break;
  case "deliveries":
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/deliveries";
    $repo['repository_id'] = 5;
    $repo['active'] = false;
    break;
  case "one-time-token":
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/one-time-token";
    $repo['repository_id'] = 6;
    $repo['active'] = false;
    break;
  case "feature-flag":
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/feature-flag";
    $repo['repository_id'] = 7;
    $repo['active'] = false;
    break;
  case "email":
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/email";
    $repo['repository_id'] = 8;
    $repo['active'] = false;
    break;
  case "platform":
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/platform";
    $repo['repository_id'] = 9;
    $repo['active'] = false;
    break;
  case "feature-flag-ui":
    $repo = array();
    $repo['local_directory_path'] = "/home/weedmaps/code/weedmaps/feature-flag-ui";
    $repo['repository_id'] = 10;
    $repo['active'] = false;
    break;
}

try {
  // print_r($dbSettings);
	$dbh = new PDO("mysql:host={$dbSettings['server']};dbname={$dbSettings['dbname']}", $dbSettings['user'], $dbSettings['pass']);

  // $dbhMySql = new MysqlObj($dbSettings['server'], $dbSettings['dbname'], $dbSettings['user'], $dbSettings['pass']);
  // pull data from the database
  $repoInformation = getRepoInfoInDb($dbh);
  //if ($repoInformation['active'] == 'N' || !$repo['active']) {
  if (!$repo['active']) {
    echo "repo['active'] == " . $repo['active']?'true':'false' . "\n";
    // echo "repoInformation['active'] == " . $repo['active'] . "\n";
    echo "repository is not listed as active";
    exit();
  }
  // based on the parameters from the job, we'll know to pull the correct repo

  // get the repo information
  // get the sha information for the given repository
  // executeDockerCommand($dbh, 0);
  //echo "Repo";
  //print_r($repo);
  //echo "\n\n";
  //echo "RepoInformation";
  //print_r($repoInformation);
  //echo "\n\n";
  // $repo = $repoInformation;
  // print_r($repo);


  // $gitRepoBranchInformation = updateRepoInFileSystem($dbh, $repo);
  // FIXME
  // This line breaks getting information back for some reason
  //$repo = $repoInformation;
  //echo "getting Repo Information from file system";
  //print_r($repo);
  //echo "\n\n";
  $gitRepoBranchInformation = updateRepoInFileSystem($dbh, $repo);
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
        //echo "repo: ";
        // print_r($row);
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
echo "repo array"; 
  //print_r($repo);
//echo "\n\n";
// echo "there should be a repo here";
// print_r($repo);
  echo "changing into {$repo['local_directory_path']} directory ...  \n";
  chdir($repo['local_directory_path']);
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
  $dataInDb = getPreviousBranchInformation($databaseHandler, $repo);
  if (is_null($dataInDb)) {
    $dataInDb = array(); // let's initialize the value if the value itself was null ...
  }
  //print_r($dataInDb);
  foreach ($data as $row) {
    $retVal = checkDataInDatabase($dataInDb, $row[0], $row[1]);
    switch($retVal['checkVal']) { // SHA, Branch
    case BRANCH_FOUND_IN_DATABASE_DIFFERENT_SHA_VALUE:
      $shaId = $retVal['sha_id'];
      updateBranchInformationInDatabase($databaseHandler, $shaId,  $row[0]); // SHA
      break;
    case BRANCH_FOUND_IN_DATABASE_SAME_SHA_VALUE:
      // Nothing for now
      break;
    case BRANCH_NOT_FOUND_IN_DATABASE:
      insertBranchInformationInDatabase($databaseHandler, $repo, $row[0], $row[1]); // SHA, branch
      break;
    }
  }

  // print_r($data);
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

function checkDataInDatabase($data, $sha, $branch) {
  $retVal =  array();
  

  if(array_key_exists($branch, $data)) {
    if($data[$branch]['sha_value'] == $sha) {
      $retVal['checkVal'] = BRANCH_FOUND_IN_DATABASE_SAME_SHA_VALUE;
      return $retVal;
    }
    $retVal['sha_id'] = $data[$branch]['sha_id'];
    $retVal['checkVal'] = BRANCH_FOUND_IN_DATABASE_DIFFERENT_SHA_VALUE;
    return $retVal;
  }


  $retVal['checkVal'] = BRANCH_NOT_FOUND_IN_DATABASE;

  return $retVal;
}

function getPreviousBranchInformation($databaseHandler, $repo) {
  $sql = "
    SELECT
      sha_id,
      repository_id,
      sha_value,
      branch_name,
      date_created,
      date_updated,
      date_removed
    FROM
      tbl_ghd_sha_data
    WHERE
      repository_id = :repository_id
      AND date_removed is null
  ";
  $repository_id = $repo['repository_id'];
  $sth = $databaseHandler->prepare($sql);
  $sth->bindParam(":repository_id", $repository_id, PDO::PARAM_INT);
  $result = $sth->execute();
  $dataResults = array();
  if ($result  = $sth->fetchAll(PDO::FETCH_ASSOC)) {
 // echo "there is a result\n";
      foreach ($result as $row) {
        $dataResults[$row['branch_name']] = $row;
        //print_r($row);
      }
  //print_r($dataResults);

  }
  return $dataResults;
}

function insertBranchInformationInDatabase($dbh, $repo, $sha, $branch) {
  $sql = "INSERT INTO tbl_ghd_sha_data (
      repository_id,
      sha_value, 
      branch_name
    ) VALUES (
      :repository_id,
      :sha,
      :branch
    )
    ";
  $repository_id = $repo['repository_id'];
  $sth = $dbh->prepare($sql);
  $sth->bindParam(":repository_id", $repository_id, PDO::PARAM_INT);
  $sth->bindParam(":sha", $sha, PDO::PARAM_STR);
  $sth->bindParam(":branch", $branch, PDO::PARAM_STR);
  $res = $sth->execute();
  /*
  $parameters = array();
  // $parameters[] = new Parameter(type, name, value);
  $parameters[] = new Parameter("integer", "repository_id", $repo['repository_id']);
  $parameters[] = new Parameter("string", "sha", $sha);
  $parameters[] = new Parameter("string", "branch", $branch);
  // echo $sql;
   */
  /*
  $dbh->executeSql($dbh, $sql, $parameters) ;
   */
}


function updateBranchInformationInDatabase($dbh, $sha, $shaId) {
  $sql = "
    UPDATE tbl_ghd_sha_data 
    SET
      sha_value = :sha
    WHERE
      sha_id = :id
    ";
  //$parameters = array();
  // $parameters[] = new Parameter(type, name, value);
  //$parameters[] = new Parameter("integer", "repository_id", $repo['repository_id']);
  //$parameters[] = new Parameter("string", "sha", $sha);
  // $parameters[] = new Parameter("string", "branch", $branch);
  // echo $sql;
  $sth = $dbh->prepare($sql);
  $sth->bindParam(":id", $shaId, PDO::PARAM_INT);
  $sth->bindParam(":sha", $sha, PDO::PARAM_STR);
  $res = $sth->execute();
  // $dbh->executeSql($dbh, $sql, $parameters) ;
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
