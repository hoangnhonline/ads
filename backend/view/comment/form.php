<?php
$id = 0;
if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    require_once "model/Backend.php";
    $model = new Backend;
    $detail = $model->getDetail("comment",$id);   
}
?>
<div class="row">
    <div class="col-md-8">

        <!-- Custom Tabs -->
        <button class="btn btn-primary btn-sm" onclick="location.href='index.php?mod=comment&act=list'">LIST</button>
        <div style="clear:both;margin-bottom:10px"></div>

        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333"><?php echo ($id > 0) ? "UPDATE" : "CREATE" ?> COMMENT</h2>
                <div class="clearfix"></div>
            </div><!-- /.box-header -->
            <div class="clearfix"></div>
            <div class="box-body">
            <!-- form start -->
            <form role="form" method="post" action="controller/Comment.php">
                
                <input type="hidden" value="<?php echo $id; ?>" name="id" />
                
            
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input  value="<?php echo isset($detail['name'])  ? $detail['name'] : "" ?>" type="text" name="name" id="name" class="form-control required datepicker">
                        </div>    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input  value="<?php echo isset($detail['email'])  ? $detail['email'] : "" ?>" type="text" name="email" id="email" class="form-control required datepicker">
                        </div>    
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Content</label>
                            <textarea name="content" id="content" rows="10" class="form-control"><?php echo $detail['content']; ?></textarea>
                        </div>    
                    </div>
                
                 <div class="clearfix"></div>
                </div><!-- /.box-body -->    
                <div class="box-footer">
                     <button class="btn btn-primary btnSave" type="submit">Save</button>
                     <button class="btn btn-primary" type="reset" onclick="location.href='index.php?mod=album&act=list'">Cancel</button>
                </div>
            </form>
        </div>

    </div><!-- /.col -->
</div>

</div>
