<script type="text/javascript">
    $(document).ready(function(){
        menuPageList.run();
    });
</script>


<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý menu</h1>
        </div>
        <!-- /.col-lg-12 -->
         <div class="pull-right btn-view-all">
            <a href="<?php echo base_url(); ?>index.php/admin/menu" data-toggle="tooltip" title="Xem tất cả" class="btn btn-default">Danh sách phân trang</a>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tiêu đề</th>
                                    <th>Vị trí</th>
                                    <th>Parent menu</th>
                                    <th>Bài viết liên kết</th>
                                    <th>Sửa/Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  if(count($menu_list)>0): ?>
                                    <?php foreach($menu_list as $key => $row): ?>
                                            <tr class="art-<?php echo $row['id']; ?>">
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['positions']; ?></td>
                                                <td><?php echo $row['parent']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td class="text-center">
                                                    <a title="Sửa menu" class="btn btn-success btn-xs" href="<?php echo base_url().'index.php/admin/menu_edit?me='.$row['id'] ?>">
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
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

</div>