<?php
require_once "model/Backend.php";
$model = new Backend;
$link = "index.php?mod=album&act=list";

if (isset($_GET['status']) && $_GET['status'] > 0) {
    $lang_id = (int) $_GET['status'];
    $status.="&status=$status";
} else {
    $status = -1;
}
if (isset($_GET['name']) && $_GET['name'] != '') {
    $arrCustom['name'] = $_GET['name'];      
    $link.="&name=$name";    
} else {
    $arrCustom['name'] = '';
}
if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
    $arrCustom['category_id'] = $_GET['category_id'];      
    $link.="&category_id=$category_id";    
} else {
    $arrCustom['category_id'] = -1;
}
$table = "album";
$listTotal = $model->getList($table, -1, -1, $arrCustom);

$total_record = $listTotal['total'];

$total_page = ceil($total_record / LIMIT);

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$offset = LIMIT * ($page - 1);

$list = $model->getList($table, $offset, LIMIT, $arrCustom);

?>
<?php 
$arrCate = array(
    '1' => 'Portrait Photos',
    '2' => 'Event Photos',
    '3' => 'Family &amp; Friendship Photos',
    '4' => 'Out-door or Romantic Photos',
    '5' => 'Commercial Photos',
    '6' => 'Group Photography',
);

?>
<div class="row">
    <div class="col-md-12">
    <button class="btn btn-primary btn-sm right" onclick="location.href='index.php?mod=album&act=form'">Add new</button>
         <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333">ALBUM LIST</h2>
            </div><!-- /.box-header -->
        <div class="box">
            <div class="box_search col-md-12" style="text-align:left">
                <form method="get" id="form_search" name="form_search">                    
                    <div class="col-md-4">
                         <div class="form-group">
                            <label for="name">Category</label>
                             <select class="form-control"  name="category_id" id="category_id">
                              <option value="-1">--ALL--</option>
                              <option value="1" <?php if(isset($arrCustom['category_id']) && $arrCustom['category_id']==1) echo "selected"; ?>>Portrait Photos</option>
                              <option value="2" <?php if(isset($arrCustom['category_id']) && $arrCustom['category_id']==2) echo "selected"; ?>>Event Photos</option>
                              <option value="3" <?php if(isset($arrCustom['category_id']) && $arrCustom['category_id']==3) echo "selected"; ?>>Family &amp; Friendship Photos</option>
                              <option value="4" <?php if(isset($arrCustom['category_id']) && $arrCustom['category_id']==4) echo "selected"; ?>>Out-door or Romantic Photos</option>
                              <option value="5" <?php if(isset($arrCustom['category_id']) && $arrCustom['category_id']==5) echo "selected"; ?>>Commercial Photos</option>
                              <option value="6" <?php if(isset($arrCustom['category_id']) && $arrCustom['category_id']==6) echo "selected"; ?>>Group Photography</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name='name' id='name' value="<?php echo $arrCustom['name']; ?>" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                         <div class="form-group">
                            <label for="name">&nbsp;</label><br>
                            <button class="btn btn-primary btn-sm right" type="submit">Tìm kiếm</button>
                        </div>
                    </div>
                    <input type="hidden" name="mod" value="album" />
                    <input type="hidden" name="act" value="list" />                                       
                                 
                </form>
                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th width="1%">No.</th>
                        <th width="140px">Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Date Taken</th>
                        <th>Created At</th>
                        <th>Last updated</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                    <?php
                    $i = ($page-1) * LIMIT;
                    if(!empty($list['data'])){
                    foreach ($list['data'] as $key => $row) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <?php if(!empty($row['image_url'])){ ?>
                            <img id="img_thumnails" class="img-thumbnail lazy" data-original="../<?php echo $row['image_url']; ?>" width="120" />
                            <?php }else{ ?>
                            <img id="img_thumnails" class="img-thumbnail lazy" data-original="static/img/no_image.jpg" width="120" />
                            <?php } ?>
                        </td>
                        <td>
                            <a href="index.php?mod=album&act=form&id=<?php echo $row['id']; ?>">
                                <?php echo $row['name']; ?>
                            </a>
                        </td>
                        <td><?php echo $arrCate[$row['category_id']]; ?></td>
                        <td><?php echo $row['date_taken']; ?></td>
                        <td><?php echo date('d-m-Y H:i',$row['created_at']); ?></td>
                        <td><?php echo date('d-m-Y H:i',$row['updated_at']); ?></td>
                        <td style="white-space:nowrap">
                            <a href="index.php?mod=album&act=form&id=<?php echo $row['id']; ?>">
                                <i class="fa fa-fw fa-edit"></i>
                            </a>
                            <a href="javascript:;" alias="<?php echo $row['name']; ?>" id="<?php echo $row['id']; ?>" mod="album" class="link_delete" >
                                <i class="fa fa-fw fa-trash-o"></i>
                            </a>

                        </td>
                    </tr>
                    <?php } }  ?>
                </tbody></table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">               
                <?php echo $model->phantrang($page, PAGE_SHOW, $total_page, $link); ?>
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->

</div>