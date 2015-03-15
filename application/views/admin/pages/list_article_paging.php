<table id="tableArticle" class="table table-striped table-bordered table-hover">
    <thead>
    <tr class="text-center success">
        <td ><strong>Tiêu đề bài viết</strong></td>
        <td><strong>Nội dung tóm tắt</strong></td></td>
        <td><strong>#</strong></td>
    </tr>
    </thead>
    <tbody id="view_article_list">
    <?php foreach($list_article as $key => $row): ?>
        <tr class="rowHover cursor_pointer" id="emp4">
          <td class="title_art"><?php echo $row['title']; ?></td>
          <td><?php echo $row['desc']; ?></td>
          <td class="text-center">
            <input type="radio" class="radio rdo_group_select_art" name="rdo_group_select_art" value="<?php echo $row['id'] ?>">
          </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
