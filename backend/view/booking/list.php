<?php
require_once "model/Backend.php";
$model = new Backend;
$link = "index.php?mod=booking&act=list";


if (isset($_GET['email']) && $_GET['email'] != '') {
    $arrCustom['email'] = $_GET['email'];      
    $link.="&email=$email";    
} else {
    $arrCustom['email'] = '';
}
if (isset($_GET['phone']) && $_GET['phone'] != '') {
    $arrCustom['phone'] = $_GET['phone'];      
    $link.="&phone=$phone";    
} else {
    $arrCustom['phone'] = '';
}
if (isset($_GET['created_at']) && $_GET['created_at'] != '') {
    $arrCustom['created_at'] = $_GET['created_at'];      
    $link.="&created_at=$created_at";    
} else {
    $arrCustom['created_at'] = '';
}
if (isset($_GET['event_id']) && $_GET['event_id'] != '') {
    $arrCustom['event_id'] = $_GET['event_id'];      
    $link.="&event_id=$event_id";    
} else {
    $arrCustom['event_id'] = -1;
}
if (isset($_GET['status']) && $_GET['status'] != '') {
    $arrCustom['status'] = $_GET['status'];      
    $link.="&status=$status";    
} else {
    $arrCustom['status'] = -1;
}
$table = "booking";
$listTotal = $model->getList($table, -1, -1, $arrCustom);

$total_record = $listTotal['total'];

$total_page = ceil($total_record / LIMIT);

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$offset = LIMIT * ($page - 1);

$list = $model->getList($table, $offset, LIMIT, $arrCustom);
$arrEvent = $model->getList('events', -1, -1);
?>
<div class="row">
    <div class="col-md-12">    
         <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333">BOOKING LIST</h2>
            </div><!-- /.box-header -->
        <div class="box">
            <div class="box_search col-md-12" style="text-align:left">
                <form method="get" id="form_search" name="form_search">
                    <div class="col-md-3">
                         <div class="form-group">
                            <label for="name">Event</label>
                             <select class="form-control" name="event_id" id="event_id">
                                <option value="-1">Tất cả</option>
                                <?php if(!empty($arrEvent['data'])){
                                    foreach($arrEvent['data'] as $value){ ?>
                                    <option value="<?php echo $value['id']; ?>"
                                    <?php if($arrCustom['event_id'] == $value['id']) echo "selected"; ?>
                                    ><?php echo $value['name_vi'] ?></option>
                                    <?php }
                                } ?>                        
                            </select>
                        </div>                             

                    </div>
                    <div class="col-md-3">
                         <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" name='email' id='email' value="<?php echo $arrCustom['email']; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-2">
                         <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" name='phone' id='phone' value="<?php echo $arrCustom['phone']; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-2">
                         <div class="form-group">
                            <label for="name">Status</label>
                            <select name="status" class="form-control">
                                <option value="-1"  <?php if($arrCustom['status'] == -1) echo "selected"; ?>>All</option>
                                <option value="2"  <?php if($arrCustom['status'] == 2) echo "selected"; ?>>New</option>
                                <option value="1"  <?php if($arrCustom['status'] == 1) echo "selected"; ?>>Approved</option>
                                <option value="0"  <?php if($arrCustom['status'] == 0) echo "selected"; ?>>Cancel</option>
                            </select>                  
                        </div>
                    </div>  
                    <div class="col-md-2">
                         <div class="form-group">
                            <label for="name">&nbsp;</label><br>
                            <button class="btn btn-primary btn-sm right" type="submit">Tìm kiếm</button>
                        </div>
                    </div>
                    <input type="hidden" name="mod" value="booking" />
                    <input type="hidden" name="act" value="list" />                                       
                                 
                </form>
                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th width="1%">No.</th>                        
                        <th>Event</th>
                        <th>Name</th>                        
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Persons</th>
                        <th>Notes</th>
                        <th>Created at</th>
                        <th>Status</th>
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
                        <td><?php echo $model->getNameViById('events', $row['event_id']); ?></td>              
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['persons']; ?></td>
                        <td><?php echo $row['notes']; ?></td>
                        <td><?php echo date('d-m-Y H:i',$row['created_at']); ?></td>                        
                        <td>
                            <select class="status form-control" data-value="<?php echo $row['id']; ?>" data-mod="booking">
                                <option value="2" <?php if($row['status'] == 2) echo "selected"; ?>>New</option>
                                <option value="1" <?php if($row['status'] == 1) echo "selected"; ?>>Approved</option>
                                <option value="0" <?php if($row['status'] == 0) echo "selected"; ?>>Cancel</option>
                            </select>
                        </td>
                        <td style="white-space:nowrap">                            
                            <a href="javascript:;" alias="<?php echo $row['name']; ?>" id="<?php echo $row['id']; ?>" mod="booking" class="link_delete" >
                                <i class="fa fa-fw fa-trash-o"></i>
                            </a>

                        </td>
                    </tr>
                    <?php } }else{  ?>
                    <tr>
                        <td colspan="11">Not found data.</td>
                    </tr>
                    <?php } ?>
                </tbody></table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">               
                <?php echo $model->phantrang($page, PAGE_SHOW, $total_page, $link); ?>
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->

</div>
<script type="text/javascript">
$(document).ready(function(){
    $('select.status').change(function(){
        var id = $(this).attr('data-value');
        var mod = $(this).attr('data-mod');
        if(confirm("Are you sure you want to change status ?")){
            $.ajax({
                url : 'ajax/process.php',
                type : 'POST',
                data : {
                    id : id,
                    mod : mod,
                    status : $(this).val(),
                    action : 'change-status'
                },
                success : function(data){
                    //alert('Update success');
                }
            })
        }else{
            return false;
        }
    });
});
</script>