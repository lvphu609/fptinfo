<?php 
	//class home default
	$class_content = "home-page-content col-lg-10";
	if($action_page != "home"){
		$class_content = "detail-page-content col-lg-8";
	}
?>
<div class="row float-left <?php echo $class_content; ?> col-xs-12">
    <div class="ftp-content col-lg-12">

    	<?php if(empty($article_content_detail) && empty($search_key) ) : ?>
    		<?php if(!empty($carousel_data)) { ?>
    			
			    	<div class="carousel-box"> 
			    		<div id="myCarousel" class="carousel slide" data-ride="carousel">

			    			
							    <!-- Indicators -->
							    <ol class="carousel-indicators">
							    <?php foreach ($carousel_data as $key => $ca) { ?>
							      <li data-target="#myCarousel" data-slide-to="<?php echo $key; ?>" class="<?php echo ($key==1) ? 'active' : ''; ?>"></li>
							    <?php } ?>
							    </ol>
							

						    <!-- Wrapper for slides -->
						    <div class="carousel-inner" role="listbox">
						    <?php foreach ($carousel_data as $key => $ca) { ?>
						      <div class="item <?php echo ($key==0) ? 'active' : ''; ?>">
						        <img src="<?php echo $ca['img_url']; ?>" alt="Chania" height="400">
						      </div>
						     <?php } ?>
						    </div>

						    <!-- Left and right controls -->
						    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						      <span class="sr-only">Previous</span>
						    </a>
						    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						      <span class="sr-only">Next</span>
						    </a>
						  </div>
					</div>
			    
		    <?php } ?>

	    	<?php /* if(!empty($content_home)){
	    			$content_home = str_replace('<img src="../../resources/uploads/source/','<img src="'.base_url().'resources/uploads/source/', $content_home);
		        		echo $content_home; 
		        	} */
	    	?>
	    	
	    	<?php if(!empty($article_home_list)) : ?>
	    		<?php foreach ($article_home_list as $key => $art) { ?>
	    			<div class="panel article-pannel-item">
		                <div class="panel-heading">
		                	<strong><?php echo $art['title']; ?></strong>              
		                </div>
		                <!-- /.panel-heading -->
		                <div class="panel-body">
		                	<?php 
		                		/*if(strpos($art['content'], '<img src="../../resources/uploads/source/')){
			                		$temp = substr($art['content'],0,strpos($art['content'],'<img src="../../resources/uploads/source/'));
			                		//$image = substr($art['content'], strpos($art['content'],'<img src="../../resources/uploads/source/'), strpos($art['content'],'>',strpos($art['content'],'<img src="../../resources/uploads/source/') - strpos($art['content'],'<img src="../../resources/uploads/source/')));
			                		$new_content = str_replace($temp,'', $art['content']);
			                		$image = substr($new_content,0,strpos($new_content,'>')+1);
			                		$image = str_replace('src="../../resources/uploads/source/','src="'.base_url().'resources/uploads/source/',$image);
			                		$content = $temp.$image;
			                		echo $content;
			                	}else{
			                		$temp = substr($art['content'],0,strpos($art['content'],'</p>', 100) + 1);
			                		var_dump($temp);
			                	}*/
			                	$temp = str_replace('<img src="../../resources/uploads/source/','<img src="'.base_url().'resources/uploads/source/', $art['content']);
			                	echo $temp;
		                	?>
		                </div>
		                <!-- /.panel-body -->
		            </div>
	    		<?php } ?>
        	<?php endif; ?>



    	<?php endif; ?>

        <?php if(!empty($article_content_detail)) {
        		
        	$article_content_detail = str_replace('<img src="../../resources/uploads/source/','<img src="'.base_url().'resources/uploads/source/', $article_content_detail['content']);
        		echo $article_content_detail; 
        	}
        ?>

        <?php if(!empty($search_key)) : ?>
         	<ul class="box-search-result">
         		<?php if(count($data_search) > 0){ ?>
         			<?php foreach ($data_search as $key => $row){ ?>
	                    <li class="left clearfix">
	                        <div class="serch-body clearfix">
	                            <div class="header">
	                                <a href="<?php echo base_url(); ?>index.php/home/article/<?php echo $row['id'] ; ?>">
	                                	<strong class="primary-font"><?php echo $row['title']; ?></strong>
	                                </a>
	                            </div>
	                            <p>
	                               <?php echo $row['desc']; ?>
	                            </p>
	                        </div>
	                    </li>
	                <?php } ?>
                <?php } ?>
                </ul>
         <?php endif; ?>
    </div>
</div>