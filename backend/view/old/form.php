<?php
$id = 0;
if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    require_once "model/Backend.php";
    $model = new Backend;
    $detail = $model->getDetail("old_event",$id);
    $imageArr = $model->getChild("images", "object_id", $id, 3); 
}
?>
<div class="row">
    <div class="col-md-12">

        <!-- Custom Tabs -->
        <button class="btn btn-primary btn-sm" onclick="location.href='index.php?mod=old&act=list'">LIST</button>
        <div style="clear:both;margin-bottom:10px"></div>

        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333"><?php echo ($id > 0) ? "UPDATE" : "CREATE" ?> OLD EVENT</h2>
                <div class="clearfix"></div>
            </div><!-- /.box-header -->
            <div class="clearfix"></div>
            <div class="box-body">
            <!-- form start -->
            <form role="form" method="post" action="controller/Old.php" enctype="multipart/form-data">
                <?php if($id> 0){ ?>
                <input type="hidden" value="<?php echo $id; ?>" name="id" />
                <?php } ?>
                <table class="table table-bordered">
                    <tr>
                        <th width="10%">Info</th>
                        <th width="45%"><img src="img/vn.png" /></th>
                        <th width="45%"><img src="img/en.png" /></th>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td colspan="2">
                            <select class="form-control"  name="category_id" id="category_id">
                              <option value="0">--Select--</option>
                              <option value="1" <?php if(isset($detail['category_id']) && $detail['category_id']==1) echo "selected"; ?>>Portrait Photos</option>
                              <option value="2" <?php if(isset($detail['category_id']) && $detail['category_id']==2) echo "selected"; ?>>Event Photos</option>
                              <option value="3" <?php if(isset($detail['category_id']) && $detail['category_id']==3) echo "selected"; ?>>Family &amp; Friendship Photos</option>
                              <option value="4" <?php if(isset($detail['category_id']) && $detail['category_id']==4) echo "selected"; ?>>Out-door or Romantic Photos</option>
                              <option value="5" <?php if(isset($detail['category_id']) && $detail['category_id']==5) echo "selected"; ?>>Commercial Photos</option>
                              <option value="6" <?php if(isset($detail['category_id']) && $detail['category_id']==6) echo "selected"; ?>>Group Photography</option>
                            </select>
                        </td>                        
                    </tr>
                    <tr>
                        <td>Tên event</td>
                        <td>
                            <input type="text" name="name_vi" id="name_vi" value="<?php if(isset($detail)) echo $detail['name_vi']; ?>" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="name_en" id="name_en" value="<?php if(isset($detail)) echo $detail['name_en']; ?>" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Photograper</td>
                        <td>
                            <input type="text" name="photograper_vi" id="photograper_vi" value="<?php if(isset($detail)) echo $detail['photograper_vi']; ?>" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="photograper_en" id="photograper_en" value="<?php if(isset($detail)) echo $detail['photograper_en']; ?>" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td>
                            <input type="text" name="model_vi" id="model_vi" value="<?php if(isset($detail)) echo $detail['model_vi']; ?>" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="model_en" id="model_en" value="<?php if(isset($detail)) echo $detail['model_en']; ?>" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Ngày</td>
                        <td colspan="2">
                            <input type="text" name="date_start" id="date_start" value="<?php if(isset($detail)) echo $detail['date_start']; ?>" class="datepicker form-control">
                        </td>
                    </tr>                    
                    <tr>
                        <td>Hình ảnh</td>
                        <td colspan="2">
                            <button class="btn btn-default" data-toggle="modal" data-target="#uploadImages">Browse</button>                       
                        
                            <div id="load_hinh" class="col-md-12" style="margin-top:15px">
                                <?php if(isset($imageArr) && !empty($imageArr)){ ?>
                                <?php foreach ($imageArr as $v) {
                                    $checked = $v['url'] == $detail['image_url'] ? "checked='checked'" :  "";
                                    ?>
                                <div class="col-md-3 image_upload" id="img_<?php echo $v['id']; ?>">
                                    <div class="wrapper_img_upload">
                                        <img class="img-thumbnail img-up lazy" data-original="../<?php echo $v['url']; ?>">
                                        <img data-value="<?php echo $v['url']; ?>" src="img/remove.png" class="remove_image" data-id="<?php echo $v['id']; ?>">
                                    </div>
                                    <p style="margin-top:10px">
                                        <input type="radio" <?php echo $checked; ?> name="image_url" value="<?php echo $v['url']; ?>" id="daidien_<?php echo $v['id']; ?>" /> Ảnh đại diện
                                        <input type="hidden" name="imageArr[]" value="<?php echo $v['url']; ?>" />
                                    </p>                                
                                </div>
                                <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Content</td>
                        <td>
                            <textarea class="form-control" name="content_vi" id="content"><?php if(isset($detail)) echo $detail['content_vi']; ?></textarea>
                        </td>
                        <td>
                            <textarea class="form-control" name="content_en" id="content_en"><?php if(isset($detail)) echo $detail['content_en']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button class="btn btn-primary btnSave" type="submit">Save</button>
                            <button class="btn btn-primary" type="reset" onclick="location.href='index.php?mod=event&act=list'">Cancel</button>
                        </td>
                    </tr>
                </table>
                </form>
                
        </div>

    </div><!-- /.col -->
</div>
<div class="modal fade" id="uploadImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form id="uploadForm" method="post" enctype="multipart/form-data" action="upload-event.php">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Browses Images</h4>
          </div>
          <div class="modal-body">
            <fieldset style="width: 100%; margin-bottom: 10px; height: 100px; padding: 5px;">
                <p style="font-weight:bold;font-size:20px">Press Ctrl to select multi images</p>
                <input style="border-radius:2px;" type="file" id="myfile" name="myfile[]" multiple />
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
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="static/js/form.js" type="text/javascript"></script>
<script src="js/form.js" type="text/javascript"></script>
<script type="text/javascript" src="static/js/ajaxupload.js"></script>
<div style="display: none" id="box_uploadimages">
    <div class="upload_wrapper block_auto">
        <div class="note" style="text-align:center;">Nhấn <strong>Ctrl</strong> để chọn nhiều hình.</div>
        <form id="upload_files_new" method="post" enctype="multipart/form-data" enctype="multipart/form-data" action="ajax/upload.php">
            <fieldset style="width: 100%; margin-bottom: 10px; height: 47px; padding: 5px;">
                <legend><b>&nbsp;&nbsp;Chọn hình từ máy tính&nbsp;&nbsp;</b></legend>
                <input style="border-radius:2px;" type="file" id="myfile" name="myfile[]" multiple />
                <div class="clear"></div>
                <div class="progress_upload" style="text-align: center;border: 1px solid;border-radius: 3px;position: relative;display: none;">
                    <div class="bar_upload" style="background-color: grey;border-radius: 1px;height: 13px;width: 0%;"></div >
                    <div class="percent_upload" style="color: #FFFFFF;left: 140px;position: absolute;top: 1px;">0%</div >
                </div>
            </fieldset>
        </form>
    </div>
</div>
<link href="<?php echo STATIC_URL; ?>css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(function(){
    $('#choose_img_sv').on('ifChecked', function(event){
        $('#from_sv').show();
        $('#from_cp').hide();
    });
    $('#choose_img_cp').on('ifChecked', function(event){
        $('#from_cp').show();
        $('#from_sv').hide();
    });    
    $('#uploadForm').ajaxForm({
        beforeSend: function() {                
        },
        uploadProgress: function(event, position, total, percentComplete) {
            $('#loading').show();
            $('#wForm').hide();
        },
        complete: function(res) { 
            var data  = JSON.parse(res.responseText);
            $( "#btnClose" ).click();  
            $('#wForm').show();  
            $('#load_hinh').append(data.html);            
            $('#loading').hide();  
            $('#myfile').val('');

        }
    }); 
    $(document).on('click','.remove_image', function(){
        var obj = $(this);
        if(confirm('Are you sure you want to remove this image?')){
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
                }
            });

        }    
    });
  
}); 
</script>
<script>
  $(function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
  <script type="text/javascript">

var editor = CKEDITOR.replace( 'content',{

    uiColor : '#9AB8F3',

    language:'vi',

    height:400,    

    skin:'kama',      

        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',    

        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

    toolbar:[

    ['Source','-','Save','NewPage','Preview','-','Templates'],  

    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],   

    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],

    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],

    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],

    ['Link','Unlink','Anchor'],['Maximize', 'ShowBlocks','-','About']

    ['Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],

    ['Styles','Format','Font','FontSize'],

    ['TextColor','BGColor'],

    

    ]

});     

</script>
<script type="text/javascript">

var editor = CKEDITOR.replace( 'content_en',{

    uiColor : '#9AB8F3',

    language:'vi',

    height:400,    

    skin:'kama',      

        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',    

        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

    toolbar:[

    ['Source','-','Save','NewPage','Preview','-','Templates'],  

    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],   

    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],

    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],

    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],

    ['Link','Unlink','Anchor'],['Maximize', 'ShowBlocks','-','About']

    ['Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],

    ['Styles','Format','Font','FontSize'],

    ['TextColor','BGColor'],

    

    ]

});     

</script>