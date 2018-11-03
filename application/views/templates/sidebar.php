<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
        
        <?php foreach($_SESSION['sidebar'] as $key => $val) {?>
			<li>
			  <a href='<?php echo site_url($val->name) ?>'>
				<i class='<?php echo $val->icon ?>'></i> <span><?php echo $val->title ?></span>
			  </a>
			</li>
        <?php } ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
