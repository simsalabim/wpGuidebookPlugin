<?php
require_once 'app/models/Entry.php';
require_once 'app/models/Wall.php';
require_once 'app/models/Rateable.php';
require_once 'app/core/Template.php';

$admin = false;
foreach ($_COOKIE as $name => $value) {
  if (substr_count($name, 'wordpress_logged_in')) {
    if (substr_count($value, 'admin')) {
      $admin = true;
    }
  }
}

$entryRecord = new Entry();
$wallRecord = new Wall();
$rateableRecord = new Rateable();

$uri = $_SERVER['REQUEST_URI'];
$wallId = null;
if (preg_match('#/?guidebook/(\d+)/(\d+)/?$#', $uri, $matches)) {
  $wallId = $matches[1];
  $id = $matches[2];
  $action = 'show';
  $method = null;
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = 'destroy';
  }
} elseif(preg_match('#/?guidebook/(\d+)/(\d+)/edit/?$#', $uri, $matches)) {
  $wallId = $matches[1];
  $id = $matches[2];
  $action = 'edit';
  $method = 'update';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = 'update';
  }
} elseif (preg_match('#/?guidebook/new/?$#', $uri)) {
  $action = 'new';
  $method = 'create';
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = 'create';
  }
}


if ($action == 'update') {
  $entryRecord->update($id, $_POST['entry']);
} elseif ($action =='create') {
  $id = $entryRecord->create($_POST['entry']);
}

$entry = $entryRecord->find(array('id' => $id, 'climbing_wall_id' => $wallId));
$entry = $entry[0];
$rating = $rateableRecord->getRate($entryRecord->getTableName(), $entry['id']);

$walls = $wallRecord->find(array('orderBy' => 'id'));

$tpl = new Template('views/show');
$tpl->assign(array(
  'entry' => $entry,
  'plugin_dir' => basename(dirname(__FILE__)),
  'action' => $action,
  'rating' => $rating,
  'admin' => $admin,
  'method' => $method,
  'walls' => $walls,
  'wallId' => $wallId
));
    
$tpl->render();

