<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box-body">
	<div class='col-md-1'></div>
	<div class='col-md-10'>
		<div class="form-horizontal">
		<?php
		foreach($list as $key=>$val){?>
			<div class='form-group hovering with-bottom-border'>
					<?php echo print_form($val,true); ?>
			</div>
		<?php } ?>
		</div>
	</div>
	<div class='col-md-1'></div>
</div>
<div class="box-footer">
	<div class="col-md-1"></div>
	<div class="col-md-2">
		<a href=<?php echo "'".site_url("addeditdelete/delete/".$noDaft)."'"; ?> class="btn btn-danger btn-block pull-left" id="hapusCatar"><i class="glyphicon glyphicon-remove-circle"></i> Hapus</a>				
	</div>
	<div class="col-md-2">
		<a href=<?php echo "'".site_url("addeditdelete/edit/".$noDaft)."'"; ?> class="btn btn-success btn-block pull-left" id="editCatar"><i class="fa fa-fw fa-edit"></i> Edit</a>				
	</div>
	<div class="col-md-2">
		<a href=<?php echo "'".site_url("addeditdelete/akun_test/".$noDaft)."'"; ?> class="btn btn-info btn-block pull-left" id="akunTestCatar"><i class="fa fa-fw fa-user-plus"></i> Akun Test</a>				
	</div>
	<div class="col-md-2">
		<a href=<?php echo "'".site_url("documents/formulir_catar/".$noDaft)."'"; ?> class="btn btn-warning btn-block pull-left" id="formulirCatar" target="_blank"><i class="fa fa-fw fa-file"></i> Formulir</a>				
	</div>
	
	<?php if($isAlreadySuratPanggilan || $_SESSION['level']>=98):
		if(!$isAlreadySuratPanggilan){
			$url = 'addeditdelete/generate_no_surat/'.$noDaft;
			$link_label = "Generate";
		}
		else{
			$url = 'documents/print_surat/'.$noDaft;
			$link_label = "Print";
		}
	?>
	<div class="col-md-2">
		<a href=<?php echo "'".site_url($url)."'"; ?> class="btn btn-primary btn-block pull-left" id="printCatar" target="_blank"><i class="fa fa-fw fa-print"></i> <?php echo $link_label; ?></a>				
	</div>
	<?php endif; ?>
	
	<div class="col-md-1"></div>
</div>
