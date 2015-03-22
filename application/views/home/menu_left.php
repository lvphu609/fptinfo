<div id="navbarCollapseLeft" class="collapse navbar-collapse col-lg-2 col-xs-12 col-md-12 float-left navbar-menu-left">
    <ul class="nav nav-list col-lg-12">
        <?php if(count($menu_left) > 0) : ?>
            <?php foreach ($menu_left as $keyP => $mnP) {
                $urlP = "#";
                if($mnP['article_id'] != 0){
                    $urlP = base_url().'index.php/home/article/'.$mnP['article_id'];
                }
                echo '<li class="mn-parent"><a href="'.$urlP.'" >'.$mnP['name'].' <span class="glyphicon glyphicon-triangle-right"></span></a></li>';
                if(!empty($mnP['submenu'])){
                    if(count($mnP['submenu'] > 0)){
                        foreach ($mnP['submenu'] as $keyS => $mnS) {
                            $urlS = "#";
                            if($mnS['article_id'] != 0){
                                $urlS = base_url().'index.php/home/article/'.$mnS['article_id'];
                            }
                            echo '<li><a href="'.$urlS.'" >'.$mnS['name'].' <span class="glyphicon glyphicon-triangle-right"></span></a></li>';
                        }
                    }
                }
            } ?>
        <?php endif; ?>
    </ul>
</div>