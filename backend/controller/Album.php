<?php



$list_url = "../index.php?mod=album&act=list";
require_once "../model/Backend.php";
$model = new Backend;
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0 ;
$arrData['name'] = $name = $model->processData($_POST['name']);
$arrData['category_id'] = (int) $_POST['category_id'];
$arrData['display_order'] = 1;
$arrData['date_taken'] = $_POST['date_taken'];
$arrData['image_url'] = str_replace('../', '', $_POST['image_url']);
$imageArr = $_POST['imageArr'];
$arrData['status'] = 1;
$table = "album";

if($id > 0) {	

	$arrData['id'] = $id;

	$arrData['updated_at'] = time();

	$model->update($table, $arrData);	

}else{

	$arrData['created_at'] = time();

	$arrData['updated_at'] = time();

	$id = $model->insert($table, $arrData);	

}

mysql_query("DELETE FROM images WHERE object_id = $id AND object_type = 1");

if(!empty($imageArr)){

    foreach ($imageArr as $url) {

        if($url){

            mysql_query("INSERT INTO images VALUES(null,'$url',$id,1,1)") or die(mysql_error());

        }

    }

}



header('location:'.$list_url);

?>