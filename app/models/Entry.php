<?php

require_once dirname(__FILE__) . '/../core/Active_Record.php';
require_once dirname(__FILE__) . '/Image.php';

class Entry extends Active_Record {

  protected $tableName = 'wp_guidebook_entries';

  public function __construct() {
    parent::__construct(dirname(__FILE__)  . '/../db.config');
  }
  
  public function find($conditions = array()) {
    $result = parent::find($conditions);
    foreach ($result as $key => $row) {
      foreach ($row as $field => $value) {
        if (in_array($field, array('title', 'description', 'description_plain_text'))) {
          $result[$key][$field] = stripslashes(html_entity_decode($value));
          $description = preg_replace('#<iframe\s*src=.*embed/(\w+).*</iframe>#','[youtube]http://www.youtube.com/watch?v=$1[/youtube]', $result[$key][$field]);
          $result[$key][$field]  = $description;
        }
      }
    }
    return $result;
  }

   public function create($record) {
      $description = preg_replace('#\[youtube.*\].*\?v=(\w+)&?.*\[/youtube\]#','<iframe width="560" height="349" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>', $record['description']);
     $record['description'] = $description;
     if ($_FILES['upload']['name']) {
       $imageRecord = new Image();
       $path = $imageRecord->create();
       $record['image'] = $path;
     }
     //print_r($record);die;
     //print_r($_FILES);die;
     //print_r(htmlspecialchars($d));die;
     //print_r($m);die;
     //print_r($description);die;
     parent::create($record);
   }
   
   
   public function update($id, $record) {
     //$description = htmlspecialchars($record['description']);
     //preg_match('#\[youtube.*\].*\?v=(\w+)&?.*\[/youtube\]#', $record['description'], $m);
     //\s*[width=]?(\d*)\s*[height=]?(\d*)\.*
     //$d = preg_replace('#.*\[youtube[width=]?(\d*)[height=]?(\d*)\.*\].*\?v=(\w+)&?.*\[/youtube\].*#','<iframe width="$1" height="$2" src="http://www.youtube.com/embed/$3" frameborder="0" allowfullscreen></iframe>', $description);
     $description = preg_replace('#\[youtube.*\].*\?v=(\w+)&?.*\[/youtube\]#','<iframe width="560" height="349" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>', $record['description']);
     $record['description'] = $description;
     if ($_FILES['upload']['name']) {
       $imageRecord = new Image();
       $path = $imageRecord->create();
       $record['image'] = $path;
     }
     
     //print_r(htmlspecialchars($d));die;
     //print_r($m);die;
     //print_r($description);die;
     parent::update($id, $record);
   }
  

}