<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box box-default">
	<div class="box-body">
		<div class='form-horizontal'>
			<div class='form-group hovering with-bottom-border'>
				<?php echo print_form($list['status'],true,array(2,10));?>
			</div>
			<div class='form-group hovering with-bottom-border'>
				<?php echo print_form($list['tanggal_aktif'],true,array(2,10));?>
			</div>
			<div class='form-group hovering with-bottom-border'>
				<?php echo print_form($list['noDaft'],true,array(2,10));?>
			</div>
			<div class='form-group hovering with-bottom-border'>
				<?php echo print_form($list['nama'],true,array(2,10));?>
			</div>
			<div class='form-group hovering with-bottom-border'>
				<?php echo print_form($list['prodi'],true,array(2,10));?>
			</div>
			<div class='form-group hovering with-bottom-border'>
				<?php echo print_form($list['gelombang'],true,array(2,10));?>
			</div>
			<?php if($status):?>
			<div class='form-group' style='margin:5px 0px;' >
				<div class='col-md-2'></div>
				<div class='col-md-6'>
					<div class='row' id='delete_confirm'>
						<button class='btn btn-danger' id='delete_confirm'>BATALKAN HERREGISTRASI</button>
					</div>
					<div class='row' style='display:none;'>
						<div class='col-md-2'>
							<button class='btn btn-success btn-block' id='cancel_delete'>CANCEL</button>
						</div>
						<div class='col-md-3'>
							<form method='POST' class='pull-left' action='<?php echo site_url($controller.'/delete/'.$noDaft); ?>'>
								<input type=hidden name=data_id value=<?php echo $noDaft;?>>
								<input type=submit class='btn btn-block btn-danger' value='BATALKAN'>
							</form>
						</div>
					</div>
				</div>
				<div class='col-md-7'></div>
			</div>			
			<?php endif;?>
		</div>
		
	</div>
</div>

<form method='POST' action='<?php echo site_url($controller.'/update/'.$noDaft); ?>'>
	<div class="box">
		
		<div class="box-header">			
			<div class='form-horizontal'>
				<div class='form-group'>
				<?php echo print_form($list['tglAktifKeuangan'],true,array(1,5));?>
				</div>
			</div>
		</div>
		
		<div class="box-body">
			<div class='row'>
				<div class='col-md-4'>
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">Uang Masuk</h3>			
						</div>
						<div class="box-body">
							<div class='form-horizontal'>
								<div class='form-group'>
								<?php echo print_form($list['tglBayarMasukKeuangan'],true,array(3,9));?>
								</div>
							</div>
							<div class='form-horizontal'>
								<div class='form-group'>
								<?php echo print_form($list['jumlahBayarMasukKeuangan'],true,array(3,9));?>
								</div>
							</div>
							<div class='form-horizontal'>
								<div class='form-group'>
								<?php echo print_form($list['catatanMasukKeuangan'],true,array(3,9));?>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class='col-md-4'>
					<div class="box box-success">
						<div class="box-header">
							<h3 class="box-title">SPP</h3>			
						</div>
						<div class="box-body">
							<div class='form-horizontal'>
								<div class='form-group'>
								<?php echo print_form($list['tglBayarSPPKeuangan'],true,array(3,9));?>
								</div>
							</div>
							<div class='form-horizontal'>
								<div class='form-group'>
								<?php echo print_form($list['jumlahBayarSPPKeuangan'],true,array(3,9));?>
								</div>
							</div>
							<div class='form-horizontal'>
								<div class='form-group'>
								<?php echo print_form($list['catatanSPPKeuangan'],true,array(3,9));?>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class='col-md-4'>
					<div class="box box-warning">
						<div class="box-header">
							<h3 class="box-title">Asrama</h3>			
						</div>
						<div class="box-body">
							<div class='form-horizontal'>
								<div class='form-group'>
								<?php echo print_form($list['tglBayarAsramaKeuangan'],true,array(3,9));?>
								</div>
							</div>
							<div class='form-horizontal'>
								<div class='form-group'>
								<?php echo print_form($list['jumlahBayarAsramaKeuangan'],true,array(3,9));?>
								</div>
							</div>
							<div class='form-horizontal'>
								<div class='form-group'>
								<?php echo print_form($list['catatanAsramaKeuangan'],true,array(3,9));?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="box-footer">
			<div class='form-group'>
				<div class='col-md-5'>
					<a href='<?php echo site_url($controller.'/main'); ?>' class="btn btn-block btn-success pull-left"><i class="fa fa-fw fa-arrow-circle-left"></i> Kembali</a>
				</div>
				<div class='col-md-2'></div>
				<div class='col-md-5'>
					<input type=submit class="btn btn-block btn-primary pull-right" value='Submit'>
				</div>				
			</div>
		</div>
	</div>
</form>
