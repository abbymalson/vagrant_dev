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
    try {
      $this->_dbh = new PDO("mysql:host={$dbSettings['server']};dbname={$dbSettings['dbname']}", $dbSettings['user'], $dbSettings['pass']);
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      $this->_sth = null;
      $this->_dbh = null;
      die();
    }
  }
  public function executeSql($sql, $parameterArray) {
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

    $this->_sth = $this->_dbh->prepare($sql);
    $this->_buildParameters($parametersArray);
        
    // $sql = "insert into cli_workers (friendly_name, screen, active) values ('$friendlyName', -1, 'Y')";
      /* Delete all rows from the FRUIT table */
      // $count = $dbh->exec("DELETE FROM fruit");
    $this->_sth->execute($sql);
    return $this->_sth;
  }
  private function _buildParameters($parametersArray) {
    /*
        $this->sth->bindParam(':job_group_id', $jobGroupId, PDO::PARAM_INT);
        $this->sth->bindParam(':friendly_name', $friendlyName, PDO::PARAM_STR);
        $this->sth->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $this->sth->bindParam(':cli_job_type_id', $cliJobTypeId, PDO::PARAM_INT);
        $this->sth->bindParam(':params', $params, PDO::PARAM_STR);
     */
  }
}

