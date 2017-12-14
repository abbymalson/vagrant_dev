#! /usr/bin/php
<?php
$server="localhost";
$dbname="github_data";
$user="root";
$pass="WM41Discovery";

try {
	$dbh = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);



} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";


	$sth = null;
	$dbh = null;
    die();
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
