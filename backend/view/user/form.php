<?php 
require_once "model/Backend.php"; 
$model = new Backend; 
$arrCity = $model->getListCity();
if(isset($_GET[ 'user_id']))
{ 
	$user_id=( int) $_GET[ 'user_id']; 
	
	$detail=$model->getDetailUser($user_id);
}
if (isset($_GET['full_name']) && $_GET['full_name'] != '') {       
    $back_url .="&full_name=".$_GET['full_name'];
}
if (isset($_GET['username']) && $_GET['username'] != '') {       
    $back_url .="&username=".$_GET['username'];
}
if (isset($_GET['status']) && $_GET['status'] > -1) {    
    $back_url.="&status=".$_GET['status'];
}
?>
<div class="row">
    <div class="col-md-8">
        <!-- Custom Tabs -->
        <button class="btn btn-primary btn-sm" onclick="location.href='index.php?mod=user&act=list<?php echo $back_url; ?>'">Back</button>
        <div style="clear:both;margin-bottom:10px"></div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo ($user_id > 0) ? "Cập nhật" : "Tạo mới" ?> nhân viên</h3> </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="controller/User.php">
                <p style="color:red;font-weight:bold;margin-left:20px">Lưu ý : mật khẩu khi tạo nhân viên mặc định là 12345@6</p>
                <?php if($user_id> 0){ ?>
                <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" />
                <?php } ?>
                <input type="hidden" value="<?php echo $back_url; ?>" name="back_url" />
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên nhân viên<span class="required"> ( * ) </span></label>
                        <input value="<?php echo isset($detail['full_name'])  ? $detail['full_name'] : " " ?>" type="text" name="full_name" id="full_name" class="form-control required"> 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Điện thoại <span class="required"> ( * ) </span></label>
                        <input value="<?php echo isset($detail['phone'])  ? $detail['phone'] : " " ?>" type="text" name="phone" id="phone" class="form-control required"> 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa chỉ <span class="required"> ( * ) </span></label>
                        <input value="<?php echo isset($detail['address'])  ? $detail['address'] : " " ?>" type="text" name="address" id="address" class="form-control required"> 
                    </div>
                    <div class="form-group">
                        <label>Tỉnh/ TP<span class="required"> ( * ) </span></label>
                         <select name="city_id" id="city_id" class="form-control">                            
                             <?php foreach ($arrCity as $city){ ?>
                                <option value="<?php echo $city['city_id']; ?>" <?php echo $detail['city_id']==$city['city_id'] ? "selected" : ""; ?>>
                                    <?php echo $city['city_name']; ?></option>
                                <?php } ?>   
                           
                           </select>  
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email <span class="required"> ( * ) </span></label>
                        <input value="<?php echo isset($detail['email'])  ? $detail['email'] : " " ?>" type="text" name="email" id="email" class="form-control required"> 
                    </div>
                	<div class="form-group">
                        <label for="exampleInputEmail1">Tên đăng nhập <span class="required"> ( * ) </span></label>
                        <input value="<?php echo isset($detail['username'])  ? $detail['username'] : " " ?>"  type="text" name="username" id="username" class="form-control required"> 
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Trạng thái <span class="required"> ( * ) </span></label>
                        <select name="status" id="status" class="form-control">                                                  
                            <option value="1" <?php if($detail['status']==1) echo "selected"; ?>>Bật</option>
                            <option value="0" <?php if($detail['status']==0) echo "selected"; ?>>Tắt</option>                            
                        </select> 
                    </div>                                        
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary btnSave" type="submit">Save</button>
                    <button class="btn btn-primary" type="button" onclick="location.href='index.php?mod=user&act=list<?php echo $back_url; ?>'" >Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.col -->
</div>