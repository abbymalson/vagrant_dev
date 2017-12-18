<?php
require_once "database_settings.php";
require_once "class.parameters.php";
require_once "class.database.php";

//try {
  // $dbh = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass );

//  } catch (PDOException $e) {
//      print "Error!: " . $e->getMessage() . "<br/>";
//    $sth = null;
//    $dbh = null;
//      die();
//  }
  echo "<pre>";
  print_r($_REQUEST);
  $data = $_POST;

  // exit();

  $outputArray = array();

  $db = new MysqlObj($dbSettings['server'], $dbSettings['dbname'], $dbSettings['user'], $dbSettings['pass']);
  
  $sql = "
  ";
  $parameterArray = array();
  $type = ""; // string, integer
  $name = "";
  $value = "";
  // $parameterArray[] = new Parameter($type, $name, $value);
  echo "sql: " . $sql . "\n";
  $queryHandle = $db->executeSql($sql, $parameterArray);
  $result = $queryHandle->fetchAll();
  foreach ($result as $row) {
  }

  switch($data['job']) {
  case 'command':
    break;

  }

function getLastFiveMessagesFromSeenHistory() {
}

function getNewMessagesFromMessageHistory() {
}

// ==================================================================================================================================
function addCommandLineJob($databaseHandler, $data) {
  $friendlyName = $data['friendly_name'];
  $absolutePath = $data['absolute_path'];
  $parameters = $data['parameter_json'];
  $sql = "insert into cli_job_type
    (friendly_name, absolute_path_to_execute_job, parameters) 
    values ('$friendlyName', '$absolutePath', '$parameters')
    ";
    echo "sql: $sql";
  try {
    $databaseHandler->exec($sql);

  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";


    $sth = null;
    $dbh = null;
      die();
  }


}

function addingJobWorker($databaseHandler) {
  $friendlyName = "command line testing";
  $sql = "insert into cli_workers 
    (friendly_name, screen, active) 
    values ('$friendlyName', -1, 'Y')
    ";
    /* Delete all rows from the FRUIT table */
    // $count = $dbh->exec("DELETE FROM fruit");
    // $databaseHandler->exec($sql);
    /* Return number of rows that were deleted */
    // print("Deleted $count rows.\n");
}

?><html>
<script>
// similar behavior as an HTTP redirect
//window.location.replace("../");
</script>
</html>

// similar behavior as clicking on a link
//window.location.href = "http://stackoverflow.com";


