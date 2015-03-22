<table id="tableMenuParent" class="table table-striped table-bordered table-hover">
    <thead>
    <tr class="text-center success">
        <td ><strong>id</strong></td>
        <td><strong>Tên menu</strong></td>
        <td><strong>#</strong></td>
    </tr>
    </thead>
    <tbody id="view_article_list">
    <?php foreach($list_menu as $key => $row): ?>
        <tr class="rowHover cursor_pointer" id="emp4">
          <td class="title_art"><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td class="text-center">
            <input type="radio" class="radio rdo_group_select_parent" name="rdo_group_select_parent" value="<?php echo $row['id'] ?>">
          </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
