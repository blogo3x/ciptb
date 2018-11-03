<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php
	foreach($container as $key=>$val){?>	
	<div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title"><?php echo $box_title[$key]; ?></h3>

		  <div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-chevron-up"></i></button>
		  </div>
		</div>
		
		<div class="box-body">
			<?php echo $val; ?>
		</div>
	</div>
	
<?php
	}
	echo $script;
?>
