<?php

require_once dirname(__FILE__) . '/../core/Active_Record.php';

class Rateable extends Active_Record {

  protected $tableName = 'wp_rateable';

  public function __construct() {
    parent::__construct(dirname(__FILE__)  . '/../db.config');
  }
    
  public function getRate($rateable_type, $rateable_id) {
    $sql = "SELECT AVG(rate) as average FROM `{$this->getTableName()}` WHERE rateable_type='{$rateable_type}' AND rateable_id='{$rateable_id}'";
	$res = mysql_query($sql);
	$result = mysql_fetch_assoc($res);
	$average = $result['average'];
	return round($average, 2);
  }

  

}