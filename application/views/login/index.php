<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<link rel="shortcut icon" href="<?php echo base_url()."assets";?>/images/favicon.png" />

	<title>sisPTB</title>

	<!-- Google Font -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/fonts/SourceSansPro.css"> 

	<!-- loginstyle style -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/dist/css/loginstyle.min.css">
  
</head>

<body>
	<div class="cont">
		<div class="demo">
			<div class="login">
				<div class="login__check">
					<img style='width:90%;' src='<?php echo base_url()."assets";?>/images/logo-big-min.png'>
				</div>
				<form method=POST action = "">
					<div class="login__form">
						<div class="login__row">
							<svg class="login__icon name svg-icon" viewBox="0 0 20 20">
							<path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
							</svg>
							<input type="text" class="login__input name" name="username" placeholder="Username"/>
						</div>
					<div class="login__row">
						<svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
						<path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
						</svg>
						<input type="password" class="login__input pass" name="password" placeholder="Password"/>
					</div>
					<input type="submit" class="login__submit" value="Sign in">
					<p class="login__signup"><?php echo (isset($error)?($error):('')); ?></p>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>
