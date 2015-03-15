<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Đổi mật khẩu</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <form id="formArticle" method="post" 
        action="<?php echo base_url(); ?>index.php/admin/chpass">
        <div class="row btn-save-top">
            <div class="col-lg-12">
                <div class="pull-right">
                    <button type="submit" title="Lưu" class="btn btn-primary"><i class="fa fa-save"></i></button>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6 col-md-offset-3">
                <?php if(!empty($message)): ?>
                    <?php echo $message; ?>
                <?php endif; ?>
    			<form class="bs-example bs-example-form" data-example-id="simple-input-groups">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Tên đăng nhập: </span>
                      <input name="old_pass" disabled="disabled" class="form-control" placeholder="Tên đăng nhập" aria-describedby="basic-addon1" value="admin">
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Mật khẩu cũ: </span>
                      <input value="<?php echo (!empty($old_pass)? $old_pass : ''); ?>" name="old_pass" type="password" class="form-control" placeholder="Mật khẩu cũ" aria-describedby="basic-addon1">
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Mật khẩu mới: </span>
                      <input value="<?php echo (!empty($new_pass)? $new_pass : ''); ?>" name="new_pass" type="password" class="form-control" placeholder="Mật khẩu mới" aria-describedby="basic-addon1">
                    </div>
                    <br>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">Lặp lại mật khẩu mới: </span>
                      <input name="re_new_pass" type="password" class="form-control" placeholder="Lặp lại mật khẩu mới" aria-describedby="basic-addon1">
                    </div>
                    <br>
                </form>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </form>
    <!-- /.row -->

</div>