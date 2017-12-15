#! /usr/bin/php
<?php
$dbSettings = array();
$dbSettings['server'] = "localhost";
$dbSettings['dbname'] = "am_jobrunner";
$dbSettings['dbname2'] = "weedmaps_infrastructure";
$dbSettings['user'] = "root";
$dbSettings['pass'] = "WM41Discovery";
$environment = "performance";

$count = 0;

try {
	$dbh = new PDO("mysql:host={$dbSettings['server']};dbname={$dbSettings['dbname']}", $dbSettings['user'], $dbSettings['pass']);
	$localInfraDb = new PDO("mysql:host={$dbSettings['server']};dbname={$dbSettings['dbname2']}", $dbSettings['user'], $dbSettings['pass']);
  echo "executing Docker command ...  \n";

  $ipAddress = findIPAddressOfDatanode($environment, $localInfraDb, $count);;
  executeDockerCommand($dbh, $ipAddress, $count);


} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
	$sth = null;
	$dbh = null;
  die();
}

function findIPAddressOfDatanode($environment, $infrastructureDbHandler, $count) {
  $ipAddress = "54.190.197.237";
  try {
    $sql = '
SELECT server_id, st.server_type, e.environment_name, st.server_type_id, e.environment_id, instance_type_id, private_ip_address, public_ip_address FROM `tbl_servers` s INNER JOIN tbl_environment e ON s.environment_id = e.environment_id INNER JOIN tbl_server_type st ON st.server_type_id = s.server_type_id WHERE environment_name = "performance" and st.server_type = "Elasticsearch Data node"
		';
    echo "findIPAddressOfDatanode: \n" . $sql . "\n";


  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    $sth = null;
    $dbh = null;
  }

  // return "54.190.197.237";
  return $ipAddress;
}

function updateApi($dbh, $ipAddress, $count) {
	$output = "";
  $output .= shell_exec('cd /home/weedmaps/code/weedmaps/weedmaps_api');
	$output .= shell_exec('pwd');
	echo $output;
	chdir('/home/weedmaps/code/weedmaps/weedmaps_api');
  $output .= shell_exec('git fetch; git pull;');
  // $dockerCommand = shell_exec("docker-compose run -e ELASTICSEARCH_URL=http://{$ipAddress}:9200 web rake es:mapping:put[Core::Listing]");
  $updateApiOutputText  = shell_exec("run -e ELASTICSEARCH_URL=http://ip-10-0-0-138.us-west-2.compute.internal:9200 -e RAILS_ENV=development web rake es:mapping:put[Core::Listing]");
  $output .= $updateApiOutputText;
  //echo "command output" . "\n";
  echo $updateApiOutputText . "\n";

  if (checkUpdateApiCommandOutputForFailureTypeTimeout($updateApiOutputText)) {
		insertJobForAdminWorker($dbh, " - Timeout");
  }
}

function checkUpdateApiCommandOutputForFailureTypeTimeout($updateApiOutputText) {
  $re = '/Timeout after 30s waiting on dependencies to become available: \[http:\/\//';
  $str = '2017/12/13 21:20:00 Timeout after 30s waiting on dependencies to become available: [http://54.187.105.250:9200]';

  // 
  if(preg_match_all($re, $updateApiOutputText, $matches, PREG_SET_ORDER, 0) == 1) {

		// Print the entire match result
		var_dump($matches);

		/*
		 * if matched submit followup job in database
		 */
    return true;

	};
  return false;
}

function insertJobForAdminWorker($dbh, $reason) {
  $jobGroupId = 2;
  $userId = 1;
  $cliJobTypeId = 3;
	$friendlyName = "Weedmaps API update performance - reattempt - " . $reason;
  $params = "";
  $sql = "
  insert into cli_jobs
  set
    job_group_id = :job_group_id,
    friendly_name = :friendly_name,
    user_id = :user_id,
    cli_job_type_id = :cli_job_type_id
    params = :params
    ";

			$sth = $dbh->prepare($sql);
			$sth->bindParam(':job_group_id', $jobGroupId, PDO::PARAM_INT);
			$sth->bindParam(':friendly_name', $friendlyName, PDO::PARAM_STR);
			$sth->bindParam(':user_id', $userId, PDO::PARAM_INT);
			$sth->bindParam(':cli_job_type_id', $cliJobTypeId, PDO::PARAM_INT);
			$sth->bindParam(':params', $params, PDO::PARAM_STR);
	// $sql = "insert into cli_workers (friendly_name, screen, active) values ('$friendlyName', -1, 'Y')";
		/* Delete all rows from the FRUIT table */
		// $count = $dbh->exec("DELETE FROM fruit");
	$dbh->exec($sql);
}

function getJobsToDoForCliWorkersSql() {
		$sql = 'SELECT 
		cj.cli_jobs_id,
		cj.friendly_name,
		absolute_path_to_execute_job,
		parameters,
		user_id,
		cj.cli_job_type_id,
		params,
		date_job_submitted  
		from cli_jobs cj
		join cli_job_type cjt on cj.cli_job_type_id = cjt.cli_job_type_id
		where date_job_completed is null
		order by date_job_submitted desc
		limit 1';
    echo "getJobsToDoCliWorkersSql: \n" . $sql . "\n";
		// job_id,
		//$sth = $databaseHandler->query($sql);
		/*
			$sql = "SELECT * FROM fruit WHERE calories > :calories";
			$sth = $conn->prepare($sql);
			$sth->bindParam(':calories', 100, PDO::PARAM_INT);
			$res = $sth->execute();
		*/
		return $sql;
}

function addingJobWorker($databaseHandler) {
	/*
	CREATE TABLE cli_workers
	(
		cli_worker_id int not null auto_increment,
		friendly_name varchar(255),
		screen INT,
		active ENUM('N', 'Y'),
	     PRIMARY KEY (cli_worker_id)
	);
	*/
	$friendlyName = "command line testing";
	$sql = "insert into cli_workers (friendly_name, screen, active) values ('$friendlyName', -1, 'Y')";
		/* Delete all rows from the FRUIT table */
		// $count = $dbh->exec("DELETE FROM fruit");
	$databaseHandler->exec($sql);
		/* Return number of rows that were deleted */
		// print("Deleted $count rows.\n");
}


function markJobComplete($databaseHandler, $job_id, $output) {
	/*
	CREATE TABLE cli_workers
	(
		cli_worker_id int not null auto_increment,
		friendly_name varchar(255),
		screen INT,
		active ENUM('N', 'Y'),
	     PRIMARY KEY (cli_worker_id)
	);
	*/
	$sql = "update cli_jobs set date_job_completed = CURRENT_TIMESTAMP, results_full = '$output' where cli_jobs_id = $job_id";
	//$friendlyName = "command line testing";
	//$sql = "insert into cli_workers (friendly_name, screen, active) values ('$friendlyName', -1, 'Y')";
		/* Delete all rows from the FRUIT table */
		// $count = $dbh->exec("DELETE FROM fruit");
	$databaseHandler->exec($sql);
		/* Return number of rows that were deleted */
		// print("Deleted $count rows.\n");
}

