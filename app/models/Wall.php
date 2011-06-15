<?php

require_once dirname(__FILE__) . '/../core/Active_Record.php';
require_once dirname(__FILE__) . '/Image.php';

class Wall extends Active_Record {

  protected $tableName = 'wp_guidebook_walls';

  public function __construct() {
    parent::__construct(dirname(__FILE__)  . '/../db.config');
  }
  
   public function create($record) {
     $imageRecord = new Image();
     $path = $imageRecord->create();
     $record['image'] = $path;
     parent::create($record);
   }
   
   
   public function update($id, $record) {
     $imageRecord = new Image();
     $path = $imageRecord->create();
     $record['image'] = $path;
     parent::update($id, $record);
   }
  

}