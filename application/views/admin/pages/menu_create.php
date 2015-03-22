
<?php $resources = base_url().'resources/'; ?>

<script type="text/javascript" src="<?php echo $resources; ?>js/ajax_paging.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        menuPageCreate.run();
    });
</script>


<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <?php  if(empty($menu)): ?>
                <h1 class="page-header">Thêm menu</h1>
            <?php else: ?>
                <h1 class="page-header">Sửa menu</h1>
            <?php endif; ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <form id="formMenu" method="post" 
    <?php  if(empty($menu)): ?>
        action="<?php echo base_url(); ?>index.php/admin/menu_store">
    <?php else: ?>
        action="<?php echo base_url(); ?>index.php/admin/menu_update">
    <?php endif; ?>
        <div class="row btn-create-article">
            <div class="col-lg-12">
                <div class="pull-right">
                    <button type="submit" title="Lưu" class="btn btn-primary btn-save-data-menu"><i class="fa fa-save"></i></button>
                    <a href="<?php echo base_url(); ?>index.php/admin/menu" data-toggle="tooltip" title="Hủy" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6 col-md-offset-3">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Tên menu: </span>
                  <input value="<?php 
                                if(!empty($menu)){
                                    echo $menu['name'];
                                } ?>" name="mn_name" class="form-control" placeholder="Tên menu" aria-describedby="basic-addon1">
                </div>

                <br>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Vị trí: </span>
                  <!-- <input name="position"  class="form-control" placeholder="Vị trí" aria-describedby="basic-addon1"> -->
                  <select name="mn_position" class="form-control selectPosition" >
                  	<option <?php if(!empty($menu)){ if ($menu['positions'] == "top") echo "selected" ;} ?>  value="top">top</option>
                  	<option <?php if(!empty($menu)){ if ($menu['positions'] == "left") echo "selected" ;} ?> value="left">left</option>
                  	<option <?php if(!empty($menu)){ if ($menu['positions'] == "right") echo "selected" ;} ?> value="right">right</option>
                  </select>
                </div>

                <br>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Thứ tự: </span>
                  <input type="number" name="sort_order" class="form-control bfh-number" value="<?php if(!empty($menu)){
                                    echo $menu['sort_order'];
                                }else echo "0"; ?>">
                </div>

                <br>
                <div class="input-group inputSlectParent <?php if(!empty($menu)){ if ($menu['positions'] == "top") echo "hidden" ;}else{ echo "hidden";} ?>">
                  <span class="input-group-addon" id="basic-addon1">Parent menu: </span>
                  <input readonly="true" class="form-control popupSelectParentMenu" placeholder="Parent menu" aria-describedby="basic-addon1" value="<?php if(!empty($menu)){ echo $menu['parent']; } ?>">
                  <input type="hidden" name="mn_parent_id" id="mn_parent_id" value="<?php if(!empty($menu)){ echo $menu['parent']; } ?>">
                  <span class="input-group-btn">
                    <button class="btn btn-default btn-clear-parent-menu" type="button">
                      <i class="glyphicon glyphicon-remove-circle"></i>
                    </button>
                  </span>
                </div>

                <br>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Bài viết liên kết: </span>
                  <input readonly="true" class="form-control popupSelectArticle" placeholder="Bài viết liên kết" aria-describedby="basic-addon1" value="<?php if(!empty($menu)){ echo $menu['title']; } ?>">
                  <input type="hidden" name="mn_article_id" id="mn_article_id" value="<?php if(!empty($menu)){ echo $menu['article_id']; } ?>">
                  <span class="input-group-btn">
                    <button class="btn btn-default btn-clear-article-id" type="button">
                      <i class="glyphicon glyphicon-remove-circle"></i>
                    </button>
                  </span>
                </div>
                
            </div>
        </div>

        <?php if(!empty($menu)): ?>
            <input class="menu-item-id" name="menu-id" type="hidden" value="<?php echo $menu['id']; ?>">
        <?php endif; ?>
    </form>
</div>

<div class="modal fade" id="modalShowSelectArticle" tabindex="-1" role="dialog" aria-labelledby="modalShowSelectArticle" aria-hidden="true">
	<div class="modal-dialog width700px">
  	<div class="modal-content">
  	  <div class="modal-header">
  	    <h4 class="modal-title" id="myModalLabel">Chọn bài viết</h4>
  	  </div>
  	  <div class="modal-body height350px" id="box_select_articles"></div>
  	 <div class="modal-footer">
  	    <button type="button" class="btn btn-primary btnSelectArt">Chọn</button>
  	    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
  	  </div>
  	</div>
  </div>
</div>

<div class="modal fade" id="modalShowSelectParentMenu" tabindex="-1" role="dialog" aria-labelledby="modalShowSelectParentMenu" aria-hidden="true">
  <div class="modal-dialog width700px">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Chọn menu parent</h4>
      </div>
      <div class="modal-body height350px" id="box_select_parent_menu"></div>
     <div class="modal-footer">
        <button type="button" class="btn btn-primary btnSelectParent">Chọn</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
      </div>
    </div>
  </div>
</div>

