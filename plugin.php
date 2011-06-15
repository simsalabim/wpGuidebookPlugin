<?php
/*
Plugin Name: Guidebook
Plugin URI: 
Description: 
Author: Alexander Kaupanin
Author URI: 
Version: 0.1
*/


/*function my_first_widget($args) {
    extract($args);
   
    echo $before_widget;
    //echo $before_title;
    //echo get_option('my_widget_title'); 
    //echo $after_title;
    
    $plugin_dir = basename(dirname(__FILE__));
?>

    <!--<script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.min.js"></script>-->
    
    <script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery-ui/jquery.ui.datepicker-ru.js"></script>
    <script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery-ui/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery-ui/ui-darkness/jquery-ui.css" />
    
    <script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.cluetip/jquery.cluetip.js"></script>
    <link rel="stylesheet" type="text/css" href="/wp-content/plugins/<?php echo $plugin_dir ?>/vendor/jquery.cluetip/jquery.cluetip.css" />
    
    <script type="text/javascript" src="/wp-content/plugins/<?php echo $plugin_dir ?>/app/web/js/widget.js"></script>
    <link rel="stylesheet" type="text/css" href="/wp-content/plugins/<?php echo $plugin_dir ?>/app/web/css/styles.css" />

<?php
    echo '<div id="datepicker"></div>';
    echo $after_widget;
}
*/

//function register_my_widget() {
    //register_sidebar_widget('Events Calendar Widget', 'my_first_widget');
    //register_widget_control('Events Calendar Widget', 'my_widget_control' );
//}


//function my_widget_control() {
    //if (! empty($_REQUEST['my_widget_title'])) {
        //update_option('my_widget_title', $_REQUEST['my_widget_title']);
    //}
    //echo 'Заголовок&nbsp;:&nbsp;<input type="text" name="my_widget_title" />';
//}



add_action('admin_menu', 'draw_menu_guidebook');
//add_action('init', 'register_my_widget');


// Function to deal with adding the calendar menus
function draw_menu_guidebook() {
  $allowed_group = 'manage_options';
  add_menu_page(__('Guidebook','guidebook'), __('Guidebook','guidebook'), $allowed_group, 'guidebook', 'edit_guidebook');
  add_submenu_page('guidebook', __('Manage guidebook','guidebook'), __('Manage guidebook','guidebook'), $allowed_group, 'guidebook', 'edit_guidebook');

}


function edit_guidebook() {
  require_once 'app/core/Template.php';
  require_once 'app/models/Entry.php';
  $tpl = new Template('views/show');
  $entryRecord = new Entry();
  $id = isset($_GET['id']) ? $_GET['id'] : 1;
  $entry = $entryRecord->find(array('id' => $id));
  $entry = $entry[0];
  //print_r($entry);die;

  if  ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
	$action = $data['action'];
	switch($action) {
	  case 'create': $entryRecord->create($data['entry']); break;
	  case 'update': $entryRecord->update($data['id'], $data['entry']); break;
	  case 'delete': 
	   $entryRecord->delete($data['entry']);
	   break;
	  default: ;
	}
  }
  //global $current_user, $wpdb, $users_entries;
  /*if ($id) {
    $event = $eventRecord->get($id);
	$tpl->assign(array(
      //'event' => $event,
    ));
  }*/
  $action = $id ? 'update' : 'create';
 
  //$events = $eventRecord->find(array('orderBy' => 'id'));*/
  $action = $_GET['edit'] ? 'edit' : 'show';
  
  $tpl->assign(array(
    'entry' => $entry,
    'plugin_dir' => basename(dirname(__FILE__)),
    'action' => $action
  ));
  $tpl->render();
}

