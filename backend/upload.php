<?php
function resizeHoang($file,$width,$height,$file_name,$des,$tile=1){
    
    require_once "lib/class.resize.php";
    $re = new resizes;
    $re->load($file);
    $re->resize($width,$height,$tile); // giu kich thuoc that cua hinh
    $re->save($des.$file_name); 
}
function resizeWidth($file,$width,$file_name,$des){
    require_once "lib/class.resize.php";
    $re = new resizes;
   
    $re->load($file);
   
    $re->resizeToWidth($width); // giu kich thuoc that cua hinh
    $re->save($des.$file_name);
    $fileNew = $des.$file_name;
    crop400($fileNew, $file_name, $des);

}
function crop400($file,$file_name,$des){
    require_once "lib/ImageManipulator.php";
    $im = new ImageManipulator($file);   
    $x1 = 0;
    $y1 = 0;

    $x2 = 400;
    $y2 = 300;

    $im->crop($x1, $y1, $x2, $y2); // takes care of out of boundary conditions automatically
    $im->save($des.$file_name);
}

function changeTitle($str) {
    $str = stripUnicode($str);
    $str = str_replace("?", "", $str);
    $str = str_replace("&", "", $str);
    $str = str_replace("'", "", $str);
    $str = str_replace("  ", " ", $str);
    $str = trim($str);
    $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8'); // MB_CASE_UPPER/MB_CASE_TITLE/MB_CASE_LOWER
    $str = str_replace(" ", "-", $str);
    $str = str_replace("---", "-", $str);
    $str = str_replace("--", "-", $str);
    $str = str_replace('"', '', $str);
    $str = str_replace('"', "", $str);
    $str = str_replace(":", "", $str);
    $str = str_replace("(", "", $str);
    $str = str_replace(")", "", $str);
    $str = str_replace(",", "", $str);
    $str = str_replace(".", "", $str);
    $str = str_replace(".", "", $str);
    $str = str_replace(".", "", $str);
    $str = str_replace("%", "", $str);
    return $str;
}

function stripUnicode($str) {
    if (!$str)
        return false;
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ',
        'D' => 'Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        '' => '?',
        '-' => '/'
    );
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode("|", $codau);
        $str = str_replace($arr, $khongdau, $str);
    }
    return $str;
}
$allowedExts = array("jpg", "jpeg", "gif", "png",'JPG','PNG','swf');

$strHinhAnh = "";

$is_update = isset($_POST['is_update']) ? $_POST['is_update'] : 0;
if(!is_dir("../upload/".date('Y/m/d')."/"))
mkdir("../upload/".date('Y/m/d')."/",0777,true);

$url = "../upload/".date('Y/m/d')."/";
$html ='';

if($_FILES['myfile']['size'] > 200000){   
    echo json_encode(array('error' => 'Maximum upload file size is 200KB'));
}else{ 

    $extension = end(explode(".", $_FILES["myfile"]["name"]));

    if ((
        ($_FILES["myfile"]["type"] == "image/gif") 
        || ($_FILES["myfile"]["type"] == "image/jpeg") 
        || ($_FILES["myfile"]["type"] == "image/png")
        || ($_FILES["myfile"]["type"] == "image/pjpeg" )  
        || ($_FILES["myfile"]["type"] == "application/x-shockwave-flash" ))   
    && in_array($extension, $allowedExts))
      {
      if ($_FILES["myfile"]["error"] > 0)
        {
        //echo "Return Code: " . $_FILES["myfile"]["error"] . "<br />";
        }
      else
        {       

        if (file_exists($url. $_FILES["myfile"]["name"]))
          {
          //echo $_FILES["myfile"]["name"] . " đã tồn tại. "."<br />";       
          }
        else
          {
            $arrPartImage = explode('.', $_FILES["myfile"]["name"]);

            // Get image extension
            $imgExt = array_pop($arrPartImage);

            // Get image not extension
            $img = preg_replace('/(.*)(_\d+x\d+)/', '$1', implode('.', $arrPartImage));
         
            $img = changeTitle($img);
            $img = $img."_".time();
            $name = "{$img}.{$imgExt}";           

            move_uploaded_file($_FILES["myfile"]["tmp_name"],$url.$name);
            $url_image_tmp = $url.$name;

            $url_image = str_replace('../', '', $url).$name;

          }
          }
        $checked = ($i == 0 && $is_update!=1) ? "checked='checked'" : ""; 
        $html.='<div class="col-md-12"><div class="wrapper_img_upload">';

        if($imgExt != 'swf'){
            $html.='<img src="'.$url_image_tmp.'" class="img-thumbnail">';    
        }else{
            $html.='<object type="application/x-shockwave-flash" data="'.$url_image_tmp.'">';
            $html.='<param name="movie" value="'.$url_image_tmp.'" />';
            $html.='<param name="quality" value="high"/>';
            $html.='</object>';
        }
        $html.='<img data-value="'.$url_image.'" src="img/remove.png" class="remove_image" data-id="">';
        $html.='</div>';    
        $html.='<input type="hidden" name="file_url"  aria-required="true" required="required" value="'.$url_image.'" /></div>';
        $html.='<input type="hidden" name="file_type" value="'.$imgExt.'" />';
        $arrReturn['error'] = '';
        $arrReturn['html'] = $html;

        echo json_encode($arrReturn);
    }else{
        echo json_encode(array('error' => 'File type not allow!'));
    }


}
?>