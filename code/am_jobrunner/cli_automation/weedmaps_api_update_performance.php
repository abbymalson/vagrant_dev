#! /usr/bin/php
<?php
$server="localhost";
// $dbname="";
$dbname="am_jobrunner";
$user="root";
$pass="WM41Discovery";

$count = 0;

try {
	$dbh = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
  echo "executing Docker command ...  \n";
  executeDockerCommand($dbh, 0);


} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
	$sth = null;
	$dbh = null;
  die();
}

function executeDockerCommand($dbh, $count) {
	$performanceIPAddresses = array();
	$performanceIPAddresses[] = "54.187.105.250";
	$performanceIPAddresses[] = "54.190.31.218";

	$output = "";
  $output .= shell_exec('cd /home/weedmaps/code/weedmaps/weedmaps_api');
	$output .= shell_exec('pwd');
	echo $output;
	chdir('/home/weedmaps/code/weedmaps/weedmaps_api');
  $output .= shell_exec('git fetch; git pull;');
  $dockerCommand = shell_exec("docker-compose run -e ELASTICSEARCH_URL=http://${performanceIPAddresses[$count]}:9200 web rake es:mapping:put[Core::Listing]");
  $output .= $dockerCommand;
  //echo "command output" . "\n";
  echo $dockerCommand . "\n";

  checkDockerCommandOutputForFailures($dbh, $dockerCommand);
}

function checkDockerCommandOutputForFailures($dbh, $dockerCommand) {
  $re = '/Timeout after 30s waiting on dependencies to become available: \[http:\/\//';
  $str = '2017/12/13 21:20:00 Timeout after 30s waiting on dependencies to become available: [http://54.187.105.250:9200]';

  if(preg_match_all($re, $dockerCommand, $matches, PREG_SET_ORDER, 0) == 1) {

		// Print the entire match result
		var_dump($matches);

		/*
		 * if matched submit followup job in database
		 */
		insertJobForAdminWorker($dbh);

	};
}

function insertJobForAdminWorker($dbh) {
  $jobGroupId = 2;
  $userId = 1;
  $cliJobTypeId = 3;
	$friendlyName = "Weedmaps API update performance - reattempt";
  $params = "";
  $sql = "
  insert into cli_jobs
    (
      job_group_id,
      friendly_name,
      user_id,
      cli_job_type_id,
      params
    ) values (
      $jobGroupId,
      '{$friendlyName}',
      $userId,
      $cliJobTypeId,
      '{$params}'
    );
    ";

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

