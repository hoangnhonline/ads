<?php

require_once "model/Backend.php";

$model = new Backend;

$link = "index.php?mod=user&act=list";
$link_form = "";
if (isset($_GET['status']) && $_GET['status'] > -1) {
    $status = (int) $_GET['status'];      
    $link.="&status=$status";
    $link_form .="&status=$status";
} else {
    $status = -1;
}
if(isset($_GET['full_name'])){
    $full_name = $model->processData($_GET['full_name']);
    $link.='&full_name='.$full_name;
    $link_form .="&full_name=$full_name";
}else{
    $full_name='';
}
if(isset($_GET['username'])){
    $username = $model->processData($_GET['username']);
    $link.='&username='.$username;
    $link_form .="&username=$username";
}else{
    $username='';
}
$listTotal = $model->getListUser($status,$full_name,$username,-1, -1);
$total_record = mysql_num_rows($listTotal);
$total_page = ceil($total_record / 20);
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = 20 * ($page - 1);
$list = $model->getListUser($status,$full_name,$username,$offset, 20);
$arrCity = $model->getListCity();
?>

<div class="row">

    <div class="col-md-12">    
     <?php if($model->checkprivilege(27)){ ?>
    <button class="btn btn-primary btn-sm right" onclick="location.href='index.php?mod=user&act=form<?php echo $link_form; ?>'">Tạo mới</button>        
    <?php } ?>        
         <div class="box-header">

                <h3 class="box-title">Danh sách nhân viên</h3>

            </div><!-- /.box-header -->

        <div class="box">

           <div class="box_search">                

                <form method="get" id="form_search" name="form_search">

                    <input type="hidden" name="mod" value="user" />

                    <input type="hidden" name="act" value="list" />                   
                    &nbsp;&nbsp;&nbsp;
                    Tên nhân viên &nbsp;
                    <input type="text" class="text_search" name="full_name" value="<?php echo (trim($full_name)!='') ? $full_name: ""; ?>" /> 
                    &nbsp;&nbsp;&nbsp;
                    Tên đăng nhập &nbsp;
                    <input type="text" class="text_search" name="username" value="<?php echo (trim($username)!='') ? $username: ""; ?>" /> 
                    &nbsp;&nbsp;&nbsp; 
                    Trạng thái
                    <select name="status" id="status" style="width:200px !important;height:25px;">
                        <option value="-1">Tất cả</option>                        
                        <option value="1" <?php if($status==1) echo "selected"; ?>>Bật</option>
                        <option value="0" <?php if($status==0) echo "selected"; ?>>Tắt</option>
                        
                    </select>          
                    &nbsp;&nbsp;&nbsp;

                    <button class="btn btn-primary btn-sm right" type="submit">Tìm kiếm</button>

                </form>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped" id="tbl_list">

                    <tbody><tr>

                        <th style="width: 10px">STT </th>
                        <th>Tên</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Tên đăng nhập</th>
                        <th width="120">Phân quyền</th> 
                        <th width="120">Trạng thái </th>
                        <th style="width: 40px">Thao tác</th>

                    </tr>

                    <?php

                    $i = ($page-1) * LIMIT;;

                    while ($row = mysql_fetch_assoc($list)) {                       

                    $i++;
                    if($row['user_id']!=1){
                    ?>

                    <tr>

                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['full_name']; ?></td>                        
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['email']; ?></td>                    
                        <td><?php echo $row['username']; ?></td> 
                        <td>
                            <?php if($model->checkprivilege(46)){ ?>
                             <a href="index.php?mod=user&act=privi&user_id=<?php echo $row['user_id']; ?><?php echo $link_form; ?>">

                                Phân quyền

                            </a>
                            <?php } ?>        
                        </td>
                        <td><?php echo $row['status']==1 ? "<span style='color:blue'>Bật</span>" : "<span style='color:red'>Tắt</span>"; ?></td>    
                        <td style="white-space:nowrap">
                             <?php if($model->checkprivilege(28)){ ?>
                            <a href="index.php?mod=user&act=form&user_id=<?php echo $row['user_id']; ?><?php echo $link_form; ?>" title="Click để sửa">

                                <i class="fa fa-fw fa-edit"></i>

                            </a>
                            <?php } ?>        
                             <?php if($model->checkprivilege(29)){ ?>
                            <a href="javascript:;" title="Click để xóa" alias="<?php echo $row['full_name']; ?>" id="<?php echo $row['user_id']; ?>" mod="users" class="link_delete" >    

                                <i class="fa fa-fw fa-trash-o"></i>

                            </a>   
                            <?php } ?>        

                        </td>

                    </tr>      

                    <?php } } ?>              

                </tbody></table>

            </div><!-- /.box-body -->

            <div class="box-footer clearfix">               

                <?php echo $model->phantrang($page, 5, $total_page, $link); ?>

            </div>

        </div><!-- /.box -->                           

    </div><!-- /.col -->

   

</div>