<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-6">
		
		<form name ="userinput" method="POST" action=<?php echo site_url($this->router->class."/".$this->router->method);?>>
			<div class="box box-default">
				<div class="box-header with-border">
				  <h3 class="box-title">Tambah Tahun PTB</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-chevron-up"></i></button>
				  </div>
				</div>
				
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<?php
									print_form($form_input['add_tahun_ptb'],true,array(4,8));
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type=submit class="btn btn-primary pull-left" value='Tambah'>
							</div>
						</div>
												
					</div>
				</div>
				
			</div>
		</form>
		
	</div>
</div>

