<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<link rel="shortcut icon" href="<?php echo base_url()."assets";?>/images/favicon.png" />
	
	<title><?php echo $this->router->class.">".$this->router->method; ?> - sisPTB</title>
	
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/dist/css/AdminLTE.min.css">
	<!-- PTB style -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/dist/css/ptb.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/dist/css/skins/_all-skins.min.css">

	<!-- Google Font -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/fonts/SourceSansPro.css">  
  
	<!-- jQuery 3 -->
	<script src="<?php echo base_url()."assets"; ?>/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?php echo base_url()."assets"; ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url()."assets"; ?>/bower_components/fastclick/lib/fastclick.js"></script>
	
	<?php if(isset($chart)): 
	switch($chart){
		case 'highcharts' : 
		?>
	<!-- highcharts -->
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/highcharts/css/highcharts.css">
	<script src="<?php echo base_url()."assets"; ?>/bower_components/highcharts/highcharts.js"></script>
	<script src="<?php echo base_url()."assets"; ?>/bower_components/highcharts/modules/exporting.js"></script>
	<script src="<?php echo base_url()."assets"; ?>/bower_components/highcharts/modules/export-data.js"></script>
	<?php	
		break;
	}
	?>
	<?php endif; ?>
	<!-- datepicker -->
	<script src="<?php echo base_url()."assets"; ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
	
	<!-- AdminLTE App -->
	<script>
        var AdminLTEOptions = {
          //Enable sidebar expand on hover effect for sidebar mini
          //This option is forced to true if both the fixed layout and sidebar mini
          //are used together
          sidebarExpandOnHover: true,
          //BoxRefresh Plugin
          enableBoxRefresh: true,
          //Bootstrap.js tooltip
          enableBSToppltip: true
        };
    </script>
	<script src="<?php echo base_url()."assets"; ?>/dist/js/adminlte.min.js"></script>
	
	<script>
	  $(document).ready(function () {
		$('.sidebar-menu').tree()
	  });
	  
	  $(document).ready(function () {
		$('.datepicker').datepicker({
			autoclose: true,
			orientation: 'bottom',
			todayHighlight: true,
			zIndexOffset:999,
			format: "dd-mm-yyyy"
		});
	  });
	</script>
</head>
<body class="hold-transition skin-blue-light sidebar-collapse sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src=<?php echo base_url()."assets/images/favicon.png"; ?> style="width: 40px;"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PTB</b> <img src=<?php echo base_url()."assets/images/favicon.png"; ?> style="width: 40px;"> STTKD</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		<!-- Control Sidebar Toggle Button -->
          <li>
            <a href='<?php echo site_url('login/sign_out'); ?>'><i class="fa fa-power-off"></i> Sign Out</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->
