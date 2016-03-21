<?php

require_once "../model/Backend.php";
$model = new Backend;
$event_id = isset($_POST['event_id']) ? (int) $_POST['event_id'] : 0 ;
$list_url = "../index.php?mod=event&act=lichtrinh&id=".$event_id;
$days = (int) $_POST['days'];

$arrVi = $_POST['content_vi'];
$arrEn = $_POST['content_en'];
mysql_query("DELETE FROM event_content WHERE event_id = $event_id");
if(!empty($arrVi)){
	foreach ($arrVi as $day => $value) {
		$arrData['event_id'] = $event_id;
		$arrData['days'] = $day;
		foreach ($value as $k1 => $v1) {
			if($v1 != '' && $arrEn[$day][$k1] != ''){
				$arrData['content_vi'] = $v1;
				$arrData['content_en'] = $arrEn[$day][$k1];
				$model->insert('event_content', $arrData);
			}			
		}
	}
}
header('location:'.$list_url);
?>