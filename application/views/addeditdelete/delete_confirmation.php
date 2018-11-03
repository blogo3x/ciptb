<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Apakah Anda yakin akan menghapus calon taruna di bawah ini?</h3>
	</div>
	<div class="box-body">
		<div class='col-md-1'></div>
		<div class='col-md-10'>
			<div class="form-horizontal">
			
			<?php
			foreach($list as $key=>$val){?>
				<div class='form-group'>
						<?php echo print_form($val,true,array(2,5)); ?>
				</div>
			<?php } ?>
							
			</div>
		</div>
		<div class='col-md-1'></div>
	</div>
	<div class="box-footer clearfix">			
		<div class='form-group'>
			<div class='col-md-5'>
				<a href='<?php echo site_url('listcatar/main'); ?>' type=submit class="btn btn-block btn-success pull-right" ><i class="fa fa-fw fa-arrow-circle-left"></i> Kembali</a>
			</div>
			<div class='col-md-2'></div>
			<div class='col-md-5'>
				<form name ="delete_catar" method="POST" action=<?php echo site_url($this->router->class."/".$this->router->method."/".$noDaft);?>>
					<input type=hidden name=noDaft value='<?php echo $noDaft; ?>'>
					<input type=submit class="btn btn-block btn-danger pull-right" value='Hapus'>
				</form>
			</div>
			
		</div>
	</div>
</div>
