
<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/admin">
                    <div class="avatar"></div>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right hidden-xs">
                <li><a title="Đăng xuất" href="<?php echo base_url(); ?>index.php/admin/logout"><span class="hidden-xs">Đăng xuất</span> <i class="fa fa-sign-out fa-lg"></i></a></li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/article_list"><i class="fa fa-pencil-square-o"></i> Bài viết</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/menu"><i class="fa fa-bars"></i> Quản lý menu</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/filemanager"><i class="fa fa-folder"></i> Thư viện tập tin</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/user"><i class="fa fa-user"></i> User</a>
                        </li>
                        <li  class="hidden-sm hidden-md hidden-lg">
                            <a title="Đăng xuất" href="<?php echo base_url(); ?>index.php/admin/logout">
                                <i class="fa fa-sign-out fa-lg"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>