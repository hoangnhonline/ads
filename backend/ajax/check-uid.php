<?php 
require_once "../model/Backend.php";
$model = new Backend;

$id = (int) $_POST['id'];

$str_cam = rtrim($_POST['str_cam'], ",");
$str_web = rtrim($_POST['str_web'], ",");

$sql = "SELECT id, code FROM uid WHERE campaign_id = '$str_cam' AND website_id = '$str_web' ";
if($id > 0){
	$sql .= " AND id <> $id "; 
}
$rs = mysql_query($sql);
$row = mysql_fetch_assoc($rs);
if(!empty($row)){
	echo "UID is exist with code '".$row['code']."' .Please check it in list UID";
}
?>