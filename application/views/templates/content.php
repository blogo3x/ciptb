<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo (isset($title))?($title):("Title"); ?>
        <small><?php if(isset($subtitle)) echo $subtitle;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
        <?php if(isset($controller)):?><li><a href="<?php echo site_url($controller); ?>"><?php echo $controller; ?></a></li><?php endif;?>
        <?php if(isset($method) && isset($controller)):?><li><span><?php echo $method; ?></span></li><?php endif;?>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		
      
