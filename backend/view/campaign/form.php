<?php
$id = 0;
if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    require_once "model/Backend.php";
    $model = new Backend;
    $detail = $model->getDetail("campaign",$id);    
}
?>
<div class="row">
    <div class="col-md-8">

        <!-- Custom Tabs -->
        <button class="btn btn-primary btn-sm" onclick="location.href='index.php?mod=campaign&act=list'">LIST COMPAIGN</button>
        <div style="clear:both;margin-bottom:10px"></div>

        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333">
                    <?php echo ($id > 0) ? "UPDATE" : "ADD NEW" ?> CAMPAIGN</h2>
                <div class="clearfix"></div>
            </div><!-- /.box-header -->
            <div class="clearfix"></div>
            <div class="box-body">
            <!-- form start -->
            <form role="form" method="post" id="dataForm" action="controller/Campaign.php" enctype="multipart/form-data">
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
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Width</label>
                            <input  aria-required="true" required="required" value="<?php echo isset($detail['width'])  ? $detail['width'] : "" ?>" type="text" name="width" id="width" class="form-control">
                        </div>    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Height</label>
                            <input  aria-required="true" required="required" value="<?php echo isset($detail['height'])  ? $detail['height'] : "" ?>" type="text" name="height" id="height" class="form-control">
                        </div>    
                    </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Ads banner</label>
                        <button class="btn btn-default" data-toggle="modal" data-target="#uploadImages">Browse</button>                       
                        
                        <div id="load_hinh" class="col-md-12" style="margin-top:15px">
                            
                                <?php if(isset($detail) && !empty($detail['file_url'])){ ?>
                                <div class="col-md-12">
                                    <div class="wrapper_img_upload">
                                <?php
                                    if($detail['file_type'] != 'swf'){
                                ?>
                                
                                <img id="img_thumnails" class="img-thumbnail lazy" data-original="../<?php echo $detail['file_url']; ?>" />
                                
                                <?php }else{ ?>
                                <object type="application/x-shockwave-flash" data="../<?php echo $detail['file_url']; ?>" >
                                    <param name="movie" value="../<?php echo $detail['file_url']; ?>" />
                                    <param name="quality" value="high"/>
                                </object>
                                <?php } ?>
                               
                                <img data-value="<?php echo $detail['file_url']; ?>" src="img/remove.png" class="remove_image" data-id="">
                                </div>
                                <input type="hidden" name="file_url"  aria-required="true" required="required" value="<?php echo $detail['file_url']; ?>" />
                                </div>
                                <input type="hidden" name="file_type" value="<?php echo $detail['file_type']; ?>" />                                
                            <?php }else{ ?>
                            <input type="text" style="width:0px;height:0px;border:none;" name="file_url" id="file_url" aria-required="true" required="required">
                            <?php } ?>
                        </div>
                        
                    </div>
                </div>   
                 <div class="clearfix"></div>
                </div><!-- /.box-body -->    
                <div class="box-footer">
                     <button class="btn btn-primary btnSave" type="submit">Save</button>
                     <button class="btn btn-primary" type="reset" onclick="location.href='index.php?mod=campaign&act=list'">Cancel</button>
                </div>
            </form>
        </div>

    </div><!-- /.col -->
</div>
<div class="modal fade" id="uploadImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form id="uploadForm" method="post" enctype="multipart/form-data" action="upload.php">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Browses Images/Flash</h4>
          </div>
          <div class="modal-body">
            <fieldset style="width: 100%; margin-bottom: 10px; height: 100px; padding: 5px;">                
                <input style="border-radius:2px;" type="file" id="myfile" name="myfile" />
                <div class="clear"></div>
                <div class="progress_upload" style="text-align: center;border: 1px solid;border-radius: 3px;position: relative;display: none;">
                    <div class="bar_upload" style="background-color: grey;border-radius: 1px;height: 13px;width: 0%;"></div >
                    <div class="percent_upload" style="color: #FFFFFF;left: 140px;position: absolute;top: 1px;">0%</div >
                </div>
            </fieldset>
          </div>
          <div class="modal-footer">
            <div id="loading" style="display:none;text-align:center;">
                <img src="img/loading.gif" />                 
            </div>
            <div id="wForm" style="text-align:center;">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnClose">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
          </div>
        </div>
    </form>
  </div>
</div>
</div>
<script src="static/js/form.js" type="text/javascript"></script>
<script type="text/javascript" src="static/js/ajaxupload.js"></script>
<script type="text/javascript">
$(function(){
    $('#dataForm').validate();
    
    $('#uploadForm').ajaxForm({
        beforeSend: function() {                
        },
        uploadProgress: function(event, position, total, percentComplete) {
            $('#loading').show();
            $('#wForm').hide();
        },
        complete: function(res) { 
            var data  = JSON.parse(res.responseText);
            if(data.error != ''){
                alert(data.error);                
            }else{
                $( "#btnClose" ).click();
                $('#load_hinh').html(data.html);                
                $('#myfile').val('');
            }
            $('#wForm').show();
            $('#loading').hide();
        }
    }); 
    $(document).on('click','.remove_image', function(){
        var obj = $(this);
        if(confirm('Are you sure you want to remove it?')){
            var image_url = obj.attr('data-value');
            var image_id = obj.attr('data-id');
            $.ajax({
                url: "ajax/remove-image.php",
                type: "POST",
                async: true,
                data: {
                    image_id : image_id,
                    image_url : image_url 
                },
                success: function(data){                    
                    obj.parent().parent().remove();
                    $('#load_hinh').html('<input type="text" style="width:0px;height:0px;border:none;" name="file_url" id="file_url" aria-required="true" required="required">');
                }
            });
        }    
    });  
}); 
</script>