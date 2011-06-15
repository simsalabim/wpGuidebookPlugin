<?php
require_once 'app/models/Wall.php';
require_once 'app/models/Rateable.php';
require_once 'app/core/Template.php';

$wallRecord = new Wall();
$walls = $wallRecord->find(array('orderBy' => 'id'));

$tpl = new Template('views/list_walls');
$tpl->assign(array(
  'walls' => $walls,
  'plugin_dir' => basename(dirname(__FILE__)),
  'admin' => current_user_can('manage_options')
));

$tpl->render();

