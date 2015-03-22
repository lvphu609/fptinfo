<div class="container fpt-menu-top">
     <nav role="navigation" class="navbar navbar-default">
        <div class="navbar-header">
            <span data-target="#navbarCollapseRight" data-toggle="collapse" class="navbar-toggle icon-green btn-navbar-collapse-right">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-align-right"></span>
            </span>
            <span data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle icon-orange  btn-navbar-collapse-top">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-menu-hamburger"></span>
            </span>
            <span data-target="#navbarCollapseLeft" data-toggle="collapse" class="navbar-toggle icon-blue  btn-navbar-collapse-left">
                <span class="sr-only">Toggle navigation</span>
                <span class="glyphicon glyphicon-align-left"></span>
            </span>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url(); ?>index.php/home" >TRANG CHỦ</a></li>
                <?php if(count($menu_top) > 0) : ?>
                    <?php foreach ($menu_top as $mn_top) : ?>
                        <li><a href="<?php echo base_url(); ?>index.php/home/article/<?php echo $mn_top['article_id']; ?>" ><?php echo $mn_top['name']; ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <li><a href="#" >TUYỂN DỤNG</a></li>
            </ul>
        </div>
    </nav>
</div>
<div class="container pan-body">


