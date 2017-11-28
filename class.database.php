/*
Version: 1
Author: Douglas Evert
Date: 11/28/2017
Purpose: to create a connection and execution of database activities
*/

<?php
class database {
    //created this class for a different class but will act as my basic backbone for our database connections
    //this class will allow us to query using prepared statements and will let us execute and fetch those records as well
  private $con;
  private $stmt;
  public function connect(){
    $config = parse_ini_file('/var/conf/config.ini');
    try {
      $this->con = new PDO($config['dsn'], $config['username'], $config['password']);
      return $this->con;
    }catch (exception $e){
      echo '<p>Connection Failure: ' . $e . "</p>";
      return null;
    }
  }
  public function query($query){
    $this->stmt = $this->con->prepare($query);
  }
  public function execute(){
    $this->stmt->execute();
  }
  public function results(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }
}
 ?>