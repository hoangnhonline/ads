<?php
$list_url = "../index.php?mod=website&act=list";
require_once "../model/Backend.php";
$model = new Backend;
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0 ;
$arrData['name'] = $name = $model->processData($_POST['name']);
$arrData['website_url'] = $model->processData($_POST['website_url']);
$arrData['status'] = (int) $_POST['status'];
$arrData['display_order'] = 1;
$table = "website";
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