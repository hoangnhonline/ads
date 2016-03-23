<?php
$id = 0;
if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    require_once "model/Backend.php";
    $model = new Backend;
    $detail = $model->getDetail("uid",$id);  
    $compaignArrSelected = explode(",", $detail['campaign_id']);
    $websiteArrSelected = explode(",", $detail['website_id']);  
}
$compaignArr = $model->getList('campaign');
$websiteArr = $model->getList('website');
?>
<div class="row">
    <div class="col-md-8">

        <!-- Custom Tabs -->
        <button class="btn btn-primary btn-sm" onclick="location.href='index.php?mod=uid&act=list'">LIST UID</button>
        <div style="clear:both;margin-bottom:10px"></div>

        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333">
                    <?php echo ($id > 0) ? "UPDATE" : "CREATE NEW" ?> UID</h2>
                <div class="clearfix"></div>
            </div><!-- /.box-header -->
            <div class="clearfix"></div>
            <form role="form" method="post" id="dataForm" action="controller/Uid.php">
            <div class="box-body" >            
                <?php if($id> 0){ ?>
                <input type="hidden" value="<?php echo $id; ?>" name="id" id="uid_id" />
                <?php }else{ ?>
                <input type="hidden" value="0" id="uid_id" />
                <?php } ?>
                <?php 
                if(!empty($detail)){
                ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Code</label>
                        <input value="<?php echo $detail['code']; ?>" type="text" disabled="disabled" class="form-control" />
                        <input type="hidden" value="<?php echo $detail['code']; ?>" name="code">
                    </div>
                </div><!-- /.box-body -->
                <?php } ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Status</label>
                        <select class="form-control"  name="status" id="status">
                          <option value="1" <?php if(isset($detail['status']) && $detail['status']==1) echo "selected"; ?>>Enable</option>
                          <option value="2" <?php if(isset($detail['status']) && $detail['status']==2) echo "selected"; ?>>Disable</option>
                         
                        </select>
                    </div>
                </div><!-- /.box-body -->
                <div class="col-md-6" >                   
                    <h4>Campaign</h4>                    
                    <?php if(!empty($compaignArr['data'])){ 
                        foreach ($compaignArr['data'] as $key => $value) {                            
                    ?>
                    <p>
                        <input <?php if(in_array($value['id'], $compaignArrSelected)) echo "checked='checked'"; ?>  type="checkbox" name="campaign_id[]" value="<?php echo $value['id']?>" class="campaign_id" id="campaign_id_<?php echo $value['id']; ?>">
                        <label for="campaign_id_<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    </p>
                    <?php } } ?>                    
                </div><!-- /.box-body -->
                <div class="col-md-6">
                    <h4>Website</h4>
                    <?php if(!empty($websiteArr['data'])){ 
                        foreach ($websiteArr['data'] as $key => $value) {                            
                    ?>
                    <p>
                        <input  <?php if(in_array($value['id'], $websiteArrSelected)) echo "checked='checked'"; ?> type="checkbox" name="website_id[]" value="<?php echo $value['id']?>" class="website_id" id="website_id_<?php echo $value['id']; ?>">
                        <label for="website_id_<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    </p>
                    <?php } } ?>      
                </div>               
                </div><!-- /.box-body -->    
                <div class="clearfix"></div>
                <div class="box-footer">
                     <button class="btn btn-primary btnSave" type="submit" onclick="return validate();">Save</button>
                     <button class="btn btn-primary" type="reset" onclick="location.href='index.php?mod=uid&act=list'">Cancel</button>
                </div>
            </form>
        </div>

    </div><!-- /.col -->
</div>
</div>
<script src="static/js/form.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
    
}); 
function validate(){
    var flag = true;
    var campaign_id = $('input.campaign_id:checked').length;
    var website_id = $('input.website_id:checked').length;
    if(campaign_id > 0 && website_id > 0){
        var str_cam = str_web = '';
        $('input.campaign_id:checked').each(function(){
            str_cam += $(this).val() + ',';
        });
        $('input.website_id:checked').each(function(){
            str_web += $(this).val() + ',';
        });
        $.ajax({
            url: "ajax/check-uid.php",
            type: "POST",
            async: true,
            data: {
                id : $('#uid_id').val(),
                str_web : str_web,
                str_cam : str_cam                
            },
            success: function(data){
                if(data != ''){
                    alert(data);
                }
            }
        });
    }else{
        alert('Please choose campaign and website!');
        flag = false;
    }
    return flag;
}
</script>