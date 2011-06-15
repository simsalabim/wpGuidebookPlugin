<?php
require_once 'app/models/Entry.php';
require_once 'app/models/Rateable.php';

$entryRecord = new Entry();
$rateableRecord = new Rateable();
$id = $_POST['id'];
$score = $_POST['score'];
$ip = $_SERVER['REMOTE_ADDR'];
$type = $entryRecord->getTableName();
$timestamp =date('Y-m-d- H:i:s');

$exists = $rateableRecord->find(array('rateable_type' => $type, 'rateable_id' => $id, 'ip' => $ip));
if (! $exists) {
  $rateableRecord->create(array('rateable_type' => $type, 'rateable_id' => $id, 'rate' => $score,'created_at' => $timestamp, 'updated_at' => $timestamp, 'ip' => $ip));
} else {
  $targetId = $exists[0]['id'];
  $rateableRecord->update($targetId, array('rate' => $score, 'updated_at' => $timestamp));
}

$newRating = $rateableRecord->getRate($type, $id);

header('Content-type: application/json');
echo json_encode($newRating);