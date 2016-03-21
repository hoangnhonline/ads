<?php
require_once "model/Backend.php";
$model = new Backend;
$link = "index.php?mod=event&act=list";

if (isset($_GET['status']) && $_GET['status'] > 0) {
    $lang_id = (int) $_GET['status'];
    $status.="&status=$status";
} else {
    $status = -1;
}
if (isset($_GET['name']) && $_GET['name'] != '') {
    $arrCustom['name_vi'] = $_GET['name'];      
    $link.="&name=$name";    
} else {
    $arrCustom['name'] = '';
}
$table = "events";
$listTotal = $model->getList($table, -1, -1, $arrCustom);

$total_record = $listTotal['total'];

$total_page = ceil($total_record / LIMIT);

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$offset = LIMIT * ($page - 1);

$list = $model->getList($table, $offset, LIMIT, $arrCustom);

?>
<div class="row">
    <div class="col-md-12">
    <button class="btn btn-primary btn-sm right" onclick="location.href='index.php?mod=event&act=form'">Add new</button>
         <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333">EVENTS LIST</h2>
            </div><!-- /.box-header -->
        <div class="box">
            <div class="box_search col-md-12" style="text-align:left">
                <form method="get" id="form_search" name="form_search">                    
                    
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name='name' id='name' value="<?php echo $arrCustom['name_vi']; ?>" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="name">&nbsp;</label><br>
                            <button class="btn btn-primary btn-sm right" type="submit">Tìm kiếm</button>
                        </div>
                    </div>
                    <input type="hidden" name="mod" value="event" />
                    <input type="hidden" name="act" value="list" />                                       
                                 
                </form>
                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th width="1%">No.</th>
                        <th width="140px">Image</th>
                        <th>Tên event</th>                        
                        <th>Giá</th>
                        <th>Lich trình</th>
                        <th>Thời gian tạo</th>
                        <th>Cập nhật cuối</th>
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
                            <a href="index.php?mod=event&act=form&id=<?php echo $row['id']; ?>">
                                <?php echo $row['name_vi']; ?>                                
                            </a>
                            <br>
                            Địa điểm : <?php echo $row['dia_diem_vi']; ?>
                            <br>
                            Ngày bắt đầu : <?php echo $row['date_start']; ?>
                            <br>
                            Số ngày : <?php echo $row['days']; ?>
                            <br>
                            Số người : <?php echo $row['persons']; ?>
                        </td>
                        
                        <td><?php echo number_format($row['prices']); ?> USD</td>
                        <td>
                            <a title="lịch trình" href="index.php?mod=event&act=lichtrinh&id=<?php echo $row['id']; ?>">
                            Lịch trình
                            </a>
                        </td>
                        <td><?php echo date('d-m-Y H:i',$row['created_at']); ?></td>
                        <td><?php echo date('d-m-Y H:i',$row['updated_at']); ?></td>
                        <td style="white-space:nowrap">
                            <a href="index.php?mod=event&act=form&id=<?php echo $row['id']; ?>">
                                <i class="fa fa-fw fa-edit"></i>
                            </a>
                            <a href="javascript:;" alias="<?php echo $row['name_vi']; ?>" id="<?php echo $row['id']; ?>" mod="event" class="link_delete" >
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