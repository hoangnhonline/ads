<?php
$id = 0;
$lichArr = array();
if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    require_once "model/Backend.php";
    $model = new Backend;
    $detailEvent = $model->getDetail("events",$id);
    $lichArr = $model->getChild("event_content", "event_id", $id); 

    if(!empty($lichArr)){
      foreach ($lichArr as $key => $value) {
        $dayArr['content_vi'][$value['days']][] = $value['content_vi'];
        $dayArr['content_en'][$value['days']][] = $value['content_en'];
      }
    }  

}
?>
<div class="row">
    <div class="col-md-12">

        <!-- Custom Tabs -->
        <button class="btn btn-primary btn-sm" onclick="location.href='index.php?mod=event&act=list'">LIST</button>
        <div style="clear:both;margin-bottom:10px"></div>

        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title" style="text-tranform:uppercase !important;color: #333333">
                    LỊCH TRÌNH EVENT : <?php echo $detailEvent['name_vi']; ?> ( <?php echo $detailEvent['days']; ?> ngày)
                </h2>
                <div class="clearfix"></div>
            </div><!-- /.box-header -->
            <div class="clearfix"></div>
            <div class="box-body">
            <!-- form start -->           
                
                <input type="hidden" value="<?php echo $id; ?>" name="event_id" />
                <input type="hidden" value="<?php echo $detailEvent['days']; ?>" name="days" />
                <table class="table table-bordered">
                    <tr>
                        <th width="100px">Ngày</th>
                        <th><img src="img/vn.png" /></th>
                        <th><img src="img/en.png" /></th>
                    </tr>
                    <?php for($i = 1; $i <= $detailEvent['days']; $i++){ ?>
                    <tr>
                        <th style="white-space:nowrap">Ngày <?php echo $i; ?>                           
                            
                        </th>
                        <td colspan="2">
                            <div class="row" id="row_<?php echo $i; ?>">
                                
                                <div style="margin-bottom:10px">
                                   
                                    <?php 
                                    if(!empty($dayArr['content_vi'][$i])){
                                        ?>
                                        <div class="col-md-6">
                                        <?php
                                      foreach ($dayArr['content_vi'][$i] as $k => $v) {
                                        ?>
                                   
                                    <?php
                                        echo "<p>-".$v."</p>";
                                      
                                    
                                    ?>
                                  
                                   <?php } ?>
                                    </div>
                                   <?php
                               }?>
                                  
                                   <?php 
                                    if(!empty($dayArr['content_en'][$i])){
                                        ?>
                                        <div class="col-md-6">
                                        <?php
                                      foreach ($dayArr['content_en'][$i] as $k => $v) {
                                        ?>
                                   
                                    <?php
                                        echo "<p>-".$v."</p>";
                                      
                                    
                                    ?>
                                   
                                   <?php } ?>
                                   </div>
                                   <?php
                               }?>
                                   <div class="clearfix"></div>
                                </div>                              
                                
                            </div>
                        </td>                        
                    </tr>
                    <?php } ?>
                    
                    <tr>
                        <td colspan="3"> 
                            <?php if(!empty($lichArr)){ ?>                           
                            <button class="btn btn-primary" type="reset" onclick="location.href='index.php?mod=event&act=lichtrinh_sua&id=<?php echo $id; ?>'">Cập nhật lịch trình</button>
                            <?php }else{ ?>
                            <button class="btn btn-primary" type="reset" onclick="location.href='index.php?mod=event&act=lichtrinh_them&id=<?php echo $id; ?>'">Thêm lịch trình</button>
                            <?php } ?>
                            <button class="btn btn-default" type="reset" onclick="location.href='index.php?mod=event&act=list'">Back</button>
                        </td>
                    </tr>
                </table>
                
                
        </div>

    </div><!-- /.col -->
</div>

</div>
<script type="text/javascript">
$(document).ready(function(){
    $('.add_more').click(function(){
        var day = $(this).attr('data-value');
        var str = '<div style="margin-bottom:10px"><div class="col-md-6">';
            str+='<textarea rows="2" name="content_vi['+ day +'][]" class="form-control"></textarea>';
            str+='</div><div class="col-md-6">';
            str+='<textarea rows="2" name="content_en['+ day +'][]" class="form-control"></textarea>';
            str+='</div><div class="clearfix"></div></div>';

        $('#row_' + day).append(str);
    });
});

</script>