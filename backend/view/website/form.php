<?php
$id = 0;
if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    require_once "model/Backend.php";
    $model = new Backend;
    $detail = $model->getDetail("website",$id);    
}
?>
<div class="row">
    <div class="col-md-8">

        <!-- Custom Tabs -->
        <button class="btn btn-primary btn-sm" onclick="location.href='index.php?mod=website&act=list'">LIST WEBSITE</button>
        <div style="clear:both;margin-bottom:10px"></div>

        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333">
                    <?php echo ($id > 0) ? "UPDATE" : "ADD NEW" ?> WEBSITE</h2>
                <div class="clearfix"></div>
            </div><!-- /.box-header -->
            <div class="clearfix"></div>
            <form role="form" method="post" id="dataForm" action="controller/Website.php">
            <div class="box-body">            
                <?php if($id> 0){ ?>
                <input type="hidden" value="<?php echo $id; ?>" name="id" />
                <?php } ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input  value="<?php echo isset($detail['name'])  ? $detail['name'] : "" ?>" type="text" name="name" id="name" class="form-control" aria-required="true" required="required">
                    </div>
                </div><!-- /.box-body -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">URL</label>
                        <input  value="<?php echo isset($detail['website_url'])  ? $detail['website_url'] : "" ?>" type="text" name="website_url" id="website_url" class="form-control" aria-required="true" required="required">
                    </div>
                </div><!-- /.box-body -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Status</label>
                        <select class="form-control"  name="status" id="status">
                          <option value="1" <?php if(isset($detail['status']) && $detail['status']==1) echo "selected"; ?>>Enable</option>
                          <option value="2" <?php if(isset($detail['status']) && $detail['status']==2) echo "selected"; ?>>Disable</option>
                         
                        </select>
                    </div>
                </div><!-- /.box-body -->
                 <div class="clearfix"></div>
                </div><!-- /.box-body -->    
                <div class="box-footer">
                     <button class="btn btn-primary btnSave" type="submit">Save</button>
                     <button class="btn btn-primary" type="reset" onclick="location.href='index.php?mod=website&act=list'">Cancel</button>
                </div>
            </form>
        </div>

    </div><!-- /.col -->
</div>
</div>
<script src="static/js/form.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
    $('#dataForm').validate();
}); 
</script>