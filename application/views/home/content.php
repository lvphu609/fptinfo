<?php 
	//class home default
	$class_content = "home-page-content col-lg-10";
	if($action_page != "home"){
		$class_content = "detail-page-content col-lg-8";
	}
?>
<div class="row float-left <?php echo $class_content; ?> col-xs-12 col-sm-12 col-md-12">
    <div class="ftp-content col-lg-12">
        content
    </div>
</div>