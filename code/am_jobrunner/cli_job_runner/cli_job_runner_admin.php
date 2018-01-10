<?php
// /usr/bin/php /vagrant/code/am_jobrunner/cli_job_runner/cli_job_runner.php

echo "hello from admin cli_job_runner \n";
require_once "actions/database_settings.php";
$IDLE_COUNTER = 50;
$boredomCounter = 50;
$display=1;

// Order
// Start vncserver
// pass in display port
 // export display port
system("export DISPLAY=:$display");
//system(' /opt/java/bin/java  -jar /opt/selenium-server.jar & ');
$autoJobsToAdd = array();
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "API Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "3", // API
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Core Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "4", // Core 
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Ionic Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "5", // Ionic 
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Moonshot Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "6", // Moonshot 
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Deliveries Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "7", // Deliveries
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "One Time Token Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "8", // One Time Token
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Feature Flag Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "9", // Feature Flag
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Email Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "10", // Email 
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Platform Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "11", // Platform
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Feature Flag Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "12", // Feature Flag UI
  "params" => "" // I don't think this does anything yet ...
);
/*
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "5", // Core 
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "5", // Core 
  "params" => "" // I don't think this does anything yet ...
);
$autoJobsToAdd[] = array(
  "job_group_id" => "1", // Good Enough for now
  "friendly_name" => "Repo Watcher",
  "user_id" => "1", // Good Enough for now
  "cli_job_type_id" => "5", // Core 
  "params" => "" // I don't think this does anything yet ...
);
 */
  
try {
    $dbh = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass, array(
        PDO::ATTR_PERSISTENT => true
    ));

    addingJobWorker($dbh);

    $timeToSleep = 1 ; //  60 * * 1000
    $loopCounter = 0;
    while(1) {
        // Check the database
        // is there jobs waiting for me?
        // Yes? DO the job
        // No? be sad and show fortunes every 60 loops
        // limit 1
        $sql = getJobsToDoForCliWorkersSql();
        // echo "SQL: " . $sql . "\n";
//        $sth = $dbh->query($sql);
        //$res = $sth->execute();
        $result = $dbh->query($sql);
        if ($result) {
// echo "there is a result\n";
            foreach ($result as $row) {
                $job_id = $row['cli_jobs_id'];
                echo "starting job: " . $row['friendly_name'] . " (" . $row['date_job_submitted'] . ")\n";
                $output = shell_exec("{$row['absolute_path_to_execute_job']} {$row['parameters']}");
                echo "\n";
                echo "OUTPUT\n";
                echo "=========================\n";
                echo $output . "\n";
                $boredomCounter = 0; // reset the boredom counter ...
                markJobComplete($dbh, $job_id, $output) ;
                echo "=== job completed ===" . "\n";
            } 
        }
           

        echo "loop:" . $loopCounter++ . "\n";
        sleep($timeToSleep); 

        if ((
            //($loopCounter + $boredomCounter) 
            $loopCounter % $IDLE_COUNTER) == 0) {
            // sudo apt-get install fortunes fortunes-off fortunes-ubuntu-server fortunes-bofh-excuses fortunes-mario
            //if ($boredomCounter > 10) {
                $output = shell_exec('fortune');
                echo "\n";
                echo "OUTPUT\n";
                echo "=========================\n";
                echo $output . "\n";
                $boredomCounter = 0; // reset the boredom counter ...
                automaticJobsToAdd($dbh, $autoJobsToAdd);
            //}
            $boredomCounter++;
        }
    }
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";


    $sth = null;
    $dbh = null;
    die();
}

function getJobsToDoForCliWorkersSql() {
// $adminSearchString = 'cli_workers.cli_worker_name = \'admin-permissions\'';

        $sql = "SELECT 
                cj.cli_jobs_id,
                cj.friendly_name,
                absolute_path_to_execute_job,
                parameters,
                user_id,
                cj.cli_job_type_id,
                params,
                date_job_submitted
                FROM 
                  tbl_jr_cli_jobs cj
    JOIN tbl_jr_cli_job_type cjt ON cj.cli_job_type_id = cjt.cli_job_type_id 
    JOIN tbl_jr_cli_workers cw ON cw.cli_worker_name = cjt.cli_worker_name
                WHERE
    cj.date_job_completed is null 
    AND cw.cli_worker_name = 'admin-permissions'
       ORDER BY date_job_submitted desc
        limit 1";
        // job_id,
        //$sth = $databaseHandler->query($sql);
        /*
            $sql = "SELECT * FROM fruit WHERE calories > :calories";
            $sth = $conn->prepare($sql);
            $sth->bindParam(':calories', 100, PDO::PARAM_INT);
            $res = $sth->execute();
        */
// echo "sql: " . $sql . "\n";
        return $sql;
}

function addingJobWorker($databaseHandler) {
    
    try {
        //$stmt = $databasehandler->prepare("update cli_jobs set date_job_completed = CURRENT_TIMESTAMP, results_full = ':results_full', results_parsed = ':results_parsed' where cli_jobs_id = :job_id");
        $friendlyName = "admin permissions";
        $cliWorkerName = "admin-permissions";
        $sql = "insert into 
          tbl_jr_cli_workers 
            (friendly_name, cli_worker_name, screen, active ) 
          values 
            ('{$friendlyName}', '{$cliWorkerName}', -1, 'Y')";
        $databaseHandler->exec($sql);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        $sth = null;
        $databaseHandler = null;
        die();
    }
}



function markJobComplete($databaseHandler, $job_id, $output) {
    try {
      $sql = "
        UPDATE 
          tbl_jr_cli_jobs
        SET 
          date_job_completed = NOW(), 
          results_full = :results_full 
          WHERE 
          cli_jobs_id = :job_id";
      $stmt = $databaseHandler->prepare($sql);
         // echo "markJobComplete sql: " . $sql . "\n"; 
          $stmt->bindValue(':results_full', $output, PDO::PARAM_STR);
          // $stmt->bindValue(':results_parsed', $output, PDO::PARAM_STR); // parsed field is too small ...
          $stmt->bindValue(':job_id', $job_id, PDO::PARAM_INT);
        $stmt->execute();
        
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        $sth = null;
        $databaseHandler = null;
        die();
    }
}



function automaticJobsToAdd($databaseHandler, $jobsToAdd) {
    try {

      $stmt = $databaseHandler->prepare("
        INSERT INTO tbl_jr_cli_jobs
          SET
            job_group_id = :job_group_id,
            friendly_name = :friendly_name,
            user_id = :user_id,
            cli_job_type_id = :cli_job_type_id,
            params = :params
        ");
        echo "automatic Jobs to Add sql: " . $sql . "\n"; 
        foreach ($jobsToAdd as $data) {
          $stmt->bindValue(':job_group_id', $data['job_group_id'], PDO::PARAM_INT);
          $stmt->bindValue(':friendly_name', $data['friendly_name'], PDO::PARAM_STR);
          $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
          $stmt->bindValue(':cli_job_type_id', $data['cli_job_type_id'], PDO::PARAM_INT);
          $stmt->bindValue(':params', $data['params'], PDO::PARAM_STR);
          $stmt->execute();
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        $sth = null;
        $databaseHandler = null;
        die();
    }
}
