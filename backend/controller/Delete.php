<?php
if(!isset($_SESSION))
{
     session_start();
}
require_once "../model/Backend.php";
$model = new Backend;

$id = $_POST['id'];

$mod = $_POST['mod'];

if($mod=='album'){
   
    // xoa project
    $sql = "DELETE FROM album WHERE id = $id";
	mysql_query($sql) or die(mysql_error() . $sql);
	// xoa images
	$sql = "DELETE FROM images WHERE object_id = $id AND object_type = 1";
	mysql_query($sql) or die(mysql_error() . $sql);
	exit;
}elseif($mod=='event'){
   
    // xoa project
    $sql = "DELETE FROM events WHERE id = $id";
	mysql_query($sql) or die(mysql_error() . $sql);
	// xoa images
	$sql = "DELETE FROM images WHERE object_id = $id AND object_type = 2";
	mysql_query($sql) or die(mysql_error() . $sql);
	$sql = "DELETE FROM event_content WHERE event_id = $id";
	mysql_query($sql) or die(mysql_error() . $sql);
	exit;
}
elseif($mod=='old_event'){
   
    // xoa project
    $sql = "DELETE FROM old_event WHERE id = $id";
	mysql_query($sql) or die(mysql_error() . $sql);
	// xoa images
	$sql = "DELETE FROM images WHERE object_id = $id AND object_type = 3";
	mysql_query($sql) or die(mysql_error() . $sql);
	
	exit;
}
?>
