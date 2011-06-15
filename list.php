<?php
require_once 'app/models/Entry.php';
require_once 'app/models/Rateable.php';
require_once 'app/core/Template.php';

$uri = $_SERVER['REQUEST_URI'];
preg_match('#/?guidebook/(\d+)/?$#', $uri, $matches);
$wallId = $matches[1];

$admin = false;
foreach ($_COOKIE as $name => $value) {
  if (substr_count($name, 'wordpress_logged_in')) {
    if (substr_count($value, 'admin')) {
      $admin = true;
    }
  }
}

$entryRecord = new Entry();
$rateableRecord = new Rateable();
$rateableType = $entryRecord->getTableName();
$entries = $entryRecord->find(array('orderBy' => 'id', 'climbing_wall_id' => $wallId));
foreach ($entries as $key => $entry) {
  $entries[$key]['rating'] = $rateableRecord->getRate($rateableType, $entry['id']);
}

$tpl = new Template('views/list');
$tpl->assign(array(
      'entries' => $entries,
	  'plugin_dir' => basename(dirname(__FILE__)),
	  'admin' => $admin
    ));
	
$tpl->render();

