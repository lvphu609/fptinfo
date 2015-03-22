
<?php $resources = base_url().'resources/'; ?>

<script type="text/javascript" src="<?php echo $resources; ?>js/ajax_paging.js"></script>
<script type="text/javascript" src="<?php echo $resources; ?>js/jquery.observe_field.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        carouselPageCreate.run();
    });
</script>


<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <?php  if(empty($carousel)): ?>
                <h1 class="page-header">Thêm hình</h1>
            <?php else: ?>
                <h1 class="page-header">Sửa hình</h1>
            <?php endif; ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <form id="formCarousel" method="post" 
    <?php  if(empty($carousel)): ?>
        action="<?php echo base_url(); ?>index.php/admin/carousel_store">
    <?php else: ?>
        action="<?php echo base_url(); ?>index.php/admin/carousel_update">
    <?php endif; ?>
        <div class="row btn-create-article">
            <div class="col-lg-12">
                <div class="pull-right">
                    <button type="submit" title="Lưu" class="btn btn-primary btn-save-data-carousel"><i class="fa fa-save"></i></button>
                    <a href="<?php echo base_url(); ?>index.php/admin/carousel" data-toggle="tooltip" title="Hủy" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6 col-md-offset-3">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Image url: </span>
                  <input readonly="true" class="form-control popupSelectImage" placeholder="Đường dẫn hình ảnh" aria-describedby="basic-addon1" value="<?php if(!empty($carousel)){ echo $carousel['img_url']; } ?>">
                  <input type="hidden" name="img_url" id="image_link" value="<?php if(!empty($carousel)){ echo $carousel['img_url']; } ?>">
                  <span class="input-group-btn">
                    <a data-target="#myModalImage" data-toggle="modal" class="btn btn-default btn-clear-article-id" type="button" 
                    href="javascript:void('')">
                      <i class="glyphicon glyphicon-folder-open"></i>
                    </a>
                  </span>
                </div>
                <br>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Thứ tự: </span>
                  <input type="number" name="sort_order" class="form-control bfh-number" value="<?php if(!empty($carousel)){
                                    echo $carousel['sort_order'];
                                }else echo "0"; ?>">
                </div>
            </div>
        </div>

        <?php if(!empty($carousel)): ?>
            <input class="carousel-item-id" name="carousel-id" type="hidden" value="<?php echo $carousel['id']; ?>">
        <?php endif; ?>
    </form>
</div>

<div class="modal fade" id="myModalImage">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title">Chọn hình</h4>
    </div>
    <div class="modal-body" style="padding:0px; margin:0px width: 560px;">
      <iframe width="100%" height="500px" src="<?php echo $resources; ?>plugins/tinymce/plugins/filemanager/dialog.php?type=1&field_id=image_link" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>


