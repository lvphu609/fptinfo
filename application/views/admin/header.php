<?php
$resources = base_url().'resources/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo $resources ?>img/fav.png">    
    <!-- stylesheet -->
	<?php
	if(isset($css_file) && count($css_file)){
	  foreach($css_file as $file){
		echo '<link rel="stylesheet" href="'.$resources.'css/'.$file.'">';
	  }
	}
	?> 
    <title><?php echo 'FPT Admin' ?></title>
</head>
<body>
<div class="container">
