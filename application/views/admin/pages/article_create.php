
<?php $resources = base_url().'resources/'; ?>

<script type="text/javascript">
    $(document).ready(function(){
        articlePageCreate.run();
    });
</script>

<script type="text/javascript" src="<?php echo $resources; ?>plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",//theme: "modern",width: 680,height: 300,
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
       ],
       toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
       toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
       image_advtab: true ,
       filemanager_crossdomain: true,
       external_filemanager_path:"<?php echo $resources; ?>plugins/tinymce/plugins/filemanager/",
       filemanager_title:"Quản lý files" ,
       external_plugins: { "filemanager" : "<?php echo $resources; ?>plugins/tinymce/plugins/filemanager/plugin.min.js"},
       setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
   });
</script>


<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <?php  if(empty($article)): ?>
                <h1 class="page-header">Bài viết mới</h1>
            <?php else: ?>
                <h1 class="page-header">Sửa bài viết</h1>
            <?php endif; ?>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <form id="formArticle" method="post" 
    <?php  if(empty($article)): ?>
        action="<?php echo base_url(); ?>index.php/admin/article_store">
    <?php else: ?>
        action="<?php echo base_url(); ?>index.php/admin/article_update">
    <?php endif; ?>
        <div class="row btn-create-article">
            <div class="col-lg-12">
                <div class="pull-right">
                    <button type="submit" form="form-category" data-toggle="tooltip" title="Lưu" class="btn btn-primary btn-save-data-article" data-original-title="Save"><i class="fa fa-save"></i></button>
                    <a href="<?php echo base_url(); ?>index.php/admin/article_list" data-toggle="tooltip" title="Hủy" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group title-article">
                    <label for="input_title" class="col-sm-2 control-label">Tiêu đề bài viết:</label>
                    <div class="col-sm-10">
                      <input name="title-article" type="text" class="form-control" id="input_title" placeholder="Tiêu đề" 
                      value=" <?php 
                                if(!empty($article)){
                                    echo $article['title'];
                                }
                            ?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group title-article">
                    <div class="col-sm-10">
                      <label><input name="home_show" type="checkbox"
                       <?php 
                                if(!empty($article)){
                                    if($article['home_show'] == 1){
                                        echo "checked";
                                    }
                                }
                        ?> value="1"> Show trang chủ</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <textarea rows="30" ="" name="box-content-article" id="box-content-article" class="col-lg-12 box-content-article">
                    <?php 
                        if(!empty($article)){
                            echo $article['content'];
                        }
                    ?>
                </textarea>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <input type="hidden" id="content_html" name="content_html" />
        <?php if(!empty($article)): ?>
            <input name="article-id" type="hidden" value="<?php echo $article['id']; ?>">
        <?php endif; ?>
    </form>
</div>

