<?php
$list_url = "../index.php?mod=old&act=list";
require_once "../model/Backend.php";
$model = new Backend;
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0 ;
$arrData['name_vi'] = $name_vi = $model->processData($_POST['name_vi']);
$arrData['name_en'] = $name_en = $model->processData($_POST['name_en']);

$arrData['alias_vi'] = $model->changeTitle($name_vi);
$arrData['alias_en'] = $model->changeTitle($name_en);

$arrData['content_vi'] = addslashes($_POST['content_vi']);
$arrData['content_en'] = addslashes($_POST['content_en']);

$arrData['photograper_vi'] = $model->processData($_POST['photograper_vi']);
$arrData['photograper_en'] = $model->processData($_POST['photograper_en']);

$arrData['model_vi'] = $model->processData($_POST['model_vi']);
$arrData['model_en'] = $model->processData($_POST['model_en']);

$arrData['category_id'] = (int) $_POST['category_id'];

$arrData['date_start'] = $_POST['date_start'];
$arrData['image_url'] = str_replace('../', '', $_POST['image_url']);

$imageArr = $_POST['imageArr'];

$table = "old_event";

if($id > 0) {	

	$arrData['id'] = $id;

	$arrData['updated_at'] = time();

	$model->update($table, $arrData);	

}else{

	$arrData['created_at'] = time();

	$arrData['updated_at'] = time();

	$id = $model->insert($table, $arrData);	

}
mysql_query("DELETE FROM images WHERE object_id = $id AND object_type = 3");

if(!empty($imageArr)){

    foreach ($imageArr as $url) {

        if($url){
            mysql_query("INSERT INTO images VALUES(null, '$url', $id, 3, 1)") or die(mysql_error());
        }

    }

}
header('location:'.$list_url);
?>
