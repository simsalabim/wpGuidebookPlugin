<?php
require_once 'app/models/Wall.php';
require_once 'app/models/Rateable.php';
require_once 'app/core/Template.php';

$wallRecord = new Wall();
$walls = $wallRecord->find(array('orderBy' => 'id'));

$admin = false;
foreach ($_COOKIE as $name => $value) {
  if (substr_count($name, 'wordpress_logged_in')) {
    if (substr_count($value, 'admin')) {
      $admin = true;
    }
  }
}

$tpl = new Template('views/list_walls');
$tpl->assign(array(
      'walls' => $walls,
	  'plugin_dir' => basename(dirname(__FILE__)),
	  'admin' => $admin
    ));
	
$tpl->render();

