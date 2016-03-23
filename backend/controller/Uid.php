<?php
$list_url = "../index.php?mod=uid&act=list";
require_once "../model/Backend.php";
$model = new Backend;
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0 ;
$arrData['status'] = (int) $_POST['status'];
$arrData['campaign_id'] = implode(",", $_POST['campaign_id']);
$arrData['website_id'] = implode(",", $_POST['website_id']);
$table = "uid";
$arrData['updated_at'] = time();
if($id > 0) {
	$arrData['id'] = $id;
	$model->update($table, $arrData);	

}else{
	$arrData['code'] = time();
	$arrData['created_at'] = time();
	$id = $model->insert($table, $arrData);	

}
header('location:'.$list_url);

?>