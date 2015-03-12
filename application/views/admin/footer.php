		

		</div>
		<!-- script -->
		<?php
		$resources = base_url().'resources/';
		if(isset($js_file) && count($js_file)){
		  foreach($js_file as $file)
		    echo '<script type="text/javascript" src="'.$resources.'js/'.$file.'"></script>';
		}
		?>
		<script type="text/javascript">
		    adminPage.run();
		</script>
	</body>
</html>