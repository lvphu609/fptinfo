<div class="col-lg-12 box-search">
	<div class="col-lg-5 box-search">
		<form method="POST" action="<?php echo base_url(); ?>index.php/home">
		    <div class="input-group">
		      <input value="<?php if(!empty($search_key)){ echo $search_key; } ?>" type="text" class="form-control" name="fpt_search" placeholder="Hãy nhập nội dung tìm kiếm">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="submit">
		        	<i class="glyphicon glyphicon-search"></i>
		        </button>
		      </span>
		    </div><!-- /input-group -->
		</form>
	 </div>
</div>