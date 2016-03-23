<?php
$list_url = "../index.php?mod=campaign&act=list";
require_once "../model/Backend.php";
$model = new Backend;
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0 ;
$arrData['name'] = $name = $model->processData($_POST['name']);
$arrData['website_url'] = $model->processData($_POST['website_url']);
$arrData['file_type'] = $model->processData($_POST['file_type']);
$arrData['width'] = $model->processData($_POST['width']);
$arrData['height'] = $model->processData($_POST['height']);
$arrData['file_url'] = str_replace('../', '', $_POST['file_url']);
$arrData['status'] = (int) $_POST['status'];
$table = "campaign";
$arrData['updated_at'] = time();
if($id > 0) {	

	$arrData['id'] = $id;
	$model->update($table, $arrData);	

}else{

	$arrData['created_at'] = time();
	$id = $model->insert($table, $arrData);	

}
header('location:'.$list_url);

?>