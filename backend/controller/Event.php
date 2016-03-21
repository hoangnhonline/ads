<?php
$list_url = "../index.php?mod=event&act=list";
require_once "../model/Backend.php";
$model = new Backend;
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0 ;
$arrData['name_vi'] = $name_vi = $model->processData($_POST['name_vi']);
$arrData['name_en'] = $name_en = $model->processData($_POST['name_en']);

$arrData['alias_vi'] = $model->changeTitle($name_vi);
$arrData['alias_en'] = $model->changeTitle($name_en);

$arrData['contact'] = $model->processData($_POST['contact']);

$arrData['name_en_vi'] = $model->stripUnicode($name_vi);
$arrData['name_en_en'] = $model->stripUnicode($name_en);

$arrData['dia_diem_vi'] = $model->processData($_POST['dia_diem_vi']);
$arrData['dia_diem_en'] = $model->processData($_POST['dia_diem_en']);

$arrData['phuong_tien_vi'] = $model->processData($_POST['phuong_tien_vi']);
$arrData['phuong_tien_en'] = $model->processData($_POST['phuong_tien_en']);

$arrData['noi_don_vi'] = $model->processData($_POST['noi_don_vi']);
$arrData['noi_don_en'] = $model->processData($_POST['noi_don_en']);

$arrData['inter_id'] = (int) $_POST['inter_id'];
$arrData['days'] = $day = (int) $_POST['days'];
$arrData['persons'] = (int) $_POST['persons'];
$arrData['prices'] = (int) $_POST['prices'];

$arrData['date_start'] = $_POST['date_start'];
$arrData['image_url'] = str_replace('../', '', $_POST['image_url']);

$pdf_url_file = $_FILES['pdf_url_file'];
$pdf_url = "";
if(($pdf_url_file['name']!='')){
	$arrRe = $model->uploadImages($pdf_url_file);	
	$pdf_url = $arrRe['filename'];
}else{
	$pdf_url = $_POST['pdf_url'];
}
$arrData['pdf_url'] = $pdf_url;

$imageArr = $_POST['imageArr'];

$table = "events";

if($id > 0) {	

	$arrData['id'] = $id;

	$arrData['updated_at'] = time();

	$model->update($table, $arrData);	

}else{

	$arrData['created_at'] = time();

	$arrData['updated_at'] = time();

	$id = $model->insert($table, $arrData);	

}
mysql_query("DELETE FROM event_content WHERE event_id = $event_id AND days > $day");
mysql_query("DELETE FROM images WHERE object_id = $id AND object_type = 2");

if(!empty($imageArr)){

    foreach ($imageArr as $url) {

        if($url){
            mysql_query("INSERT INTO images VALUES(null, '$url', $id, 2, 1)") or die(mysql_error());
        }

    }

}
header('location:'.$list_url);
?>
