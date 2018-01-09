<?php

class DatabaseObj {
  private $_dbh;
  private $_sth;
  public function __construct($host, $db, $user, $pass) {
  }
  public function executeSql($sql, $parameterArray) {
  }
  private function _buildParameters($parameterArray) {
  }
}

class MysqlObj extends DatabaseObj {
  private $_dbh;
  private $_sth;
  public function __contruct($host, $db, $user, $pass) {
      $this->_dbh = new PDO("mysql:host={$dbSettings['server']};dbname={$dbSettings['dbname']}", $dbSettings['user'], $dbSettings['pass']);
      /*
    try {
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      $this->sth = null;
      $this->dbh = null;
      die();
    }
       */
  }
  public function executeSql($sql, $parametersArray) {
    /*
    $sql = "
    insert into cli_jobs
    set
      job_group_id = :job_group_id,
      friendly_name = :friendly_name,
      user_id = :user_id,
      cli_job_type_id = :cli_job_type_id
      params = :params
      ";
     */

      // FIXME: DEBUG
      print_r($parametersArray);

        $this->_sth = $this->_dbh->prepare($sql);
        $this->_buildParameters($parametersArray);
        
    // $sql = "insert into cli_workers (friendly_name, screen, active) values ('$friendlyName', -1, 'Y')";
      /* Delete all rows from the FRUIT table */
      // $count = $dbh->exec("DELETE FROM fruit");
    return $this->_dbh->exec($sql);
  }
  private function _buildParameters($parametersArray) {
    foreach($parametersArray as $param) {
      $paramName = $param->getName();
      $paramValue = $param->getValue();
      switch($param->getParamType()) {
      case "integer":
        echo ":{$paramName}: {$paramValue} -> PDO::PARAM_INT";
        $this->sth->bindParam(":{$paramName}", $paramValue, PDO::PARAM_INT);
        break;
      case "string":
        echo ":{$paramName}: {$paramValue} -> PDO::PARAM_STR";
        $this->sth->bindParam(":{$paramName}", $paramValue, PDO::PARAM_STR);
        break;
      default:
        echo "No Type match found";
      }
    }
  }
}
