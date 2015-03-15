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
    <link rel="stylesheet" href="<?php echo $resources ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $resources ?>css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo $resources ?>css/admin.css">    
    <title><?php echo 'FPT Login' ?></title>
</head>
<body>
<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-6 col-md-offset-3">
    		<div class="login-panel panel panel-default">
			  	<div class="panel-heading">
            <div class="avatar"></div>
			 	  </div>
			  	<div class="panel-body">
            <form id="fpt-login-form" method="post" accept-charset="UTF-8" role="form" action="<?php echo base_url().'index.php/admin/auth' ?>">
              <fieldset>
                  <div class="form-group">
                    <input autofocus id="username" value="<?php if(!empty($cookie)){echo $cookie['username'];} if(!empty($username)) echo $username;  ?>" class="form-control" placeholder="Tên đăng nhập" name="username" type="text">
                </div>
                <div class="form-group">
                  <input  class="form-control" placeholder="Mật khẩu" name="password" type="password" value="<?php if(!empty($cookie)){echo '*******************';}?>">
                </div>
                <div class="checkbox">
                    <label>
                      <input id="remember" <?php if(!empty($cookie)){echo 'checked';}?> name="remember" type="checkbox" value="<?php if(!empty($cookie)){echo '1';}else{echo '0';}?>"><?php echo ' '; ?>Nhớ mật khẩu
                    </label>
                </div>
                
                <?php if(!empty($error)): ?>
                  <div class="alert alert-warning fade in">
                    Tên hoặc mật khẩu không hợp lệ.
                    <button type="button" class="close" data-dismiss="alert">×</button>        
                  </div>                
                <?php endif;?>
                <input class="btn btn-lg btn-warning btn-block" type="submit" value="Đăng nhập">
              </fieldset>
              <input type="hidden" name="encrypt-password">
			     </form>     
			    </div>
			</div>
		</div>
	</div>
</div>

<!-- script -->
<?php
if(isset($js_file) && count($js_file)){
  foreach($js_file as $file)
    echo '<script type="text/javascript" src="'.$resources.'js/'.$file.'"></script>';
}
?>
<script type="text/javascript">
    adminLogin.run();
</script>

</body>
</html>
