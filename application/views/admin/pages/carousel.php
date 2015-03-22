<script type="text/javascript">
    $(document).ready(function(){
        carouselList.run();
    });
</script>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Carousel</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                    <div class="pull-right col-lg-1 col-md-1 col-sm-3 col-xs-3">
                        <a href="<?php echo base_url(); ?>index.php/admin/carousel_create">
                            <button title="Thêm hình mới" type="button" class="btn btn-success btn-sm col-xs-12 button-add-article">
                              <span class="glyphicon glyphicon-plus"></span> 
                            </button>
                        </a>
                    </div>  
                    <div class="clear"></div>                  
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                     if(!empty($pagination)){
                        echo $pagination;
                     }
                    ?>
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Vị trí</th>
                                    <th>Sửa/Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  if(count($carousel_list)>0): ?>
                                    <?php foreach($carousel_list as $key => $row): ?>
                                            <tr class="art-<?php echo $row['id']; ?>">
                                                <td><?php echo $row['id']; ?></td>
                                                <td>
                                                    <img width="50" height="50" src="<?php echo $row['img_url']; ?>" >
                                                </td>
                                                <td><?php echo $row['sort_order']; ?></td>
                                                <td class="text-center">
                                                    <a title="Sửa menu" class="btn btn-success btn-xs" href="<?php echo base_url().'index.php/admin/carousel_edit?ca='.$row['id'] ?>">
                                                        <span class="glyphicon glyphicon-edit"></span> 
                                                    </a>
                                                    <button title="Xóa menu" type="button" data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-xs buttonDelete">
                                                      <span class="glyphicon glyphicon-trash "></span> 
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php endforeach; ?>
                                <?php endif;  ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                     if(!empty($pagination)){
                        echo $pagination;
                     }
                    ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

</div>

<div class="modal fade" id="modalDeleteItemCarousel" tabindex="-3" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header fontbold">Thông báo</div>
        <div class="modal-body">
          <i class="glyphicon warning glyphicon-warning-sign"></i>&nbsp;Bạn có muốn xóa hình đang chọn!
        </div>
        <div class="col-lg-12 messageAlert"></div>
        <div class="clear"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger btnConfirmDeleteCarousel">Xóa</button>
          <button type="button" class="btn btn-sm btn-default btnCancelDeleteMenu" data-dismiss="modal">Hủy</button>
        </div>
      </div>
    </div>
</div>