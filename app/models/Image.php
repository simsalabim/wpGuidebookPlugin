<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simsalabim
 * Date: 14.04.11
 * Time: 23:45
 * To change this template use File | Settings | File Templates.
 */
require_once dirname(__FILE__) . '/../core/Active_Record.php';

class Image extends Active_Record {

  protected $tableName = 'wp_pages_images';

  protected $enabledExtensions = array('png', 'jpg', 'jpe', 'jpeg', 'gif', 'bmp');

  protected $dataDir;

  public function __construct() {
    parent::__construct();
    $this->dataDir = dirname(__FILE__) . '/../../../../uploads/images/';
  }
  
  public function create($userId = 1, $key = 'upload', $galleryId = null) {
    $fileinfo = pathinfo($_FILES[$key]['name']);
    $type = strtolower($fileinfo['extension']);
    if (! in_array($type, $this->enabledExtensions)) {
      throw new Exception('Неверный тип загружаемого файла');
    }

    $createdAt = date('Y-m-d H:i:s');
    $filename = $_FILES[$key]['name'];

    if(! is_dir($this->dataDir)) {
      mkdir($this->dataDir, 0777);
    }

    $userFolder = $this->dataDir . $userId . '/';

    if(! is_dir($userFolder)) {
      mkdir($userFolder, 0777);
    }

    $filePath = $userFolder . $filename;

    if (! copy($_FILES[$key]['tmp_name'], $filePath)) {
      throw new Exception('Не удалось сохранить файл ' . $filename);
    };

    $filePath = '/' . $filePath;
    $relativePath = '/wp-content/uploads/images/' . $userId . '/' . $filename;
    parent::create(array('user_id' => $userId, 'path' => $relativePath, 'type' => $type, 'created_at' => $createdAt));
    return $relativePath;
  }
 
  public function getUserImages($userId) {
    $res = $this->connection->query("SELECT * FROM `{$this->tableName}` WHERE user_id={$userId} ORDER BY `created_at` DESC");
    $result = array();
    while ($row = $res->fetch()) {
      $result[] = $row['path'];
    }
    return $result;
  }

  /*public function remove($id) {
    $sql = 'DELETE FROM `' . $this->tableName . '` WHERE id=' . $id;
    return $this->connection->query($sql);
  }*/



}
