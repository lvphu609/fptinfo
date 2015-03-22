<div id="navbarCollapseRight" class="collapse navbar-collapse col-lg-2 col-xs-12 col-md-12 float-right navbar-menu-right">
    <ul class="nav nav-list col-lg-12">
        <?php if(count($menu_right) > 0) : ?>
            <?php foreach ($menu_right as $keyP => $mnP) {
                $urlP = "#";
                if($mnP['article_id'] != 0){
                    $urlP = base_url().'index.php/home/article/'.$mnP['article_id'];
                }
                echo '<li class="mn-parent"><a href="'.$urlP.'" >'.$mnP['name'].'</a></li>';
                if(!empty($mnP['submenu'])){
                    $countmn = count($mnP['submenu']);
                    if($countmn > 0){
                        foreach ($mnP['submenu'] as $keyS => $mnS) {
                            $urlS = "#";
                            if($mnS['article_id'] != 0){
                                $urlS = base_url().'index.php/home/article/'.$mnS['article_id'];
                            }

                            $classChild = '';
                            if($countmn == 1){
                                $classChild = 'class="mn-child"';
                            }
                            echo '<li '.$classChild.' ><a href="'.$urlS.'" >'.$mnS['name'].'</a></li>';
                            $countmn --;
                        }
                    }
                }
            } ?>
        <?php endif; ?>
    </ul>
</div>