<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	$tabel_width = 12;
	
	if(isset($grid_width))
		$tabel_width=$grid_width;
?>
<div class="row">
	<div class="col-md-<?php echo $tabel_width; ?>">
		<div class="box">
			<div class="box-header clearfix">
				<span>Menampilkan data <b><?php echo $current_rows; ?></b> dari <b><?php echo $total_rows; ?></b> data</span>
				<?php echo $pagination;?>
			</div>
			<div class="box-body">
				<?php echo $table;?>
			</div>
			<div class="box-footer clearfix">
				<span>Menampilkan data <b><?php echo $current_rows; ?></b> dari <b><?php echo $total_rows; ?></b> data</span>
				<?php echo $pagination;?>
			</div>
		</div>
	</div>
</div>
