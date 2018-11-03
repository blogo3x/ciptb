<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box box-danger">
	<div class="box-header with-border">
		<h3 class="box-title">Calon Taruna di bawah ini tidak dapat dihapus karena sudah Herregistrasi</h3>
	</div>
	<div class="box-body">
		<div class='row'>
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
		<div class='row'>
			<div class='col-md-1'></div>
			<div class='col-md-7'>
				<div class="callout callout-danger">
					<h4>Hubungi bagian terkait untuk konfirmasi Herregistrasi</h4>
					<p>Bisa jadi salah, bisa jadi ga. Ga tau deh..</p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="box-footer clearfix">			
		<div class='form-group'>
			<div class='col-md-5'>
				<a href='<?php echo site_url('listcatar/main'); ?>' type=submit class="btn btn-block btn-success pull-right" ><i class="fa fa-fw fa-arrow-circle-left"></i> Kembali</a>
			</div>
			<div class='col-md-2'></div>
			</div>
			
		</div>
	</div>
</div>
