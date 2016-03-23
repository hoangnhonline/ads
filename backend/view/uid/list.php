<?php
require_once "model/Backend.php";
$model = new Backend;
$link = "index.php?mod=uid&act=list";

if (isset($_GET['status']) && $_GET['status'] > 0) {
    $lang_id = (int) $_GET['status'];
    $status.="&status=$status";
} else {
    $status = -1;
}
if (isset($_GET['code']) && $_GET['code'] != '') {
    $arrCustom['code'] = $_GET['code'];      
    $link.="&code=$code";
} else {
    $arrCustom['code'] = '';
}
$table = "uid";
$listTotal = $model->getList($table, -1, -1, $arrCustom);

$total_record = $listTotal['total'];

$total_page = ceil($total_record / LIMIT);

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$offset = LIMIT * ($page - 1);

$list = $model->getList($table, $offset, LIMIT, $arrCustom);

?>
<div class="row">
    <div class="col-md-12">
    <button class="btn btn-primary btn-sm right" onclick="location.href='index.php?mod=uid&act=form'">Create new UID</button>
         <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333">LIST UID</h2>
            </div><!-- /.box-header -->
        <div class="box">
            <div class="box_search col-md-12" style="text-align:left">
                <form method="get" id="form_search" name="form_search">                    
                    
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="name">Code</label>
                            <input type="text" name='code' id='code' value="<?php echo $arrCustom['code']; ?>" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="name">&nbsp;</label><br>
                            <button class="btn btn-primary btn-sm right" type="submit">Tìm kiếm</button>
                        </div>
                    </div>
                    <input type="hidden" name="mod" value="uid" />
                    <input type="hidden" name="act" value="list" />                                       
                                 
                </form>
                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th width="1%">No.</th>                        
                        <th>Code</th>                        
                        <th>Campaign</th>
                        <th>Website</th>
                        <th>Created at</th>
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
                            <a href="index.php?mod=uid&act=form&id=<?php echo $row['id']; ?>">
                                <?php echo $row['code']; ?>                                
                            </a>
                           
                        </td>
                        
                        <td>
                            <?php 
                            $campaignArr = explode(",", $row['campaign_id']);
                            foreach ($campaignArr as $key => $value) {
                                echo $model->getNameById('campaign', $value);
                                echo "<br>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php 
                            $websiteArr = explode(",", $row['website_id']);
                            foreach ($websiteArr as $key => $value) {
                                echo $model->getNameById('website', $value);
                                echo "<br>";
                            }
                            ?>
                        </td>
                        <td><?php echo date('d-m-Y H:i',$row['created_at']); ?></td>
                        <td><?php echo date('d-m-Y H:i',$row['updated_at']); ?></td>
                        <td style="white-space:nowrap">
                            <a onclick="return pushCode(<?php echo $row['code']; ?>); " class="btn btn-sm btn-info getCode" data-value="<?php echo $value['code']; ?>">
                                GET CODE
                            </a>
                            <a class="btn btn-sm btn-warning" href="index.php?mod=uid&act=form&id=<?php echo $row['id']; ?>">
                                Edit
                            </a>
                            <a class="btn btn-sm btn-danger" href="javascript:;" alias="<?php echo $row['code']; ?>" id="<?php echo $row['id']; ?>" mod="uid" class="link_delete" >
                                Delete
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">      
      <div class="modal-body">
        <p>Put the code for the ADS anywhere you want to appear on the website</p>
        <textarea id="codeAds" style="width:100%;height:100px"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<style type="text/css">
#codeAds{
    background: none;   
    
    color: #4e5665;
    font-family: Menlo,Monaco,Andale Mono,Courier New,monospace;
    font-size: 14px;
    height: auto;
    line-height: 20px;
    padding: 12px;    
}
</style>
<script type="text/javascript">
function pushCode(code){ 
    $.ajax({
            url: "ajax/get-code.php",
            type: "POST",
            async: true,
            data: {
                code : code                      
            },
            success: function(data){
                $('textarea#codeAds').val(data);
            }
        });
    
    $('#myModal').modal('show');
    return true;
}
</script>