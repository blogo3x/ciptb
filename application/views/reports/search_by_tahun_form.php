<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
	<div class="col-md-12">
		
		<form name ="userinput" method="POST" action=<?php echo site_url($this->router->class."/".$this->router->method);?>>
			<div class="box box-success">
				<div class="box-header with-border">
				  <h3 class="box-title">Cari Rekapitulasi tahun</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-chevron-up"></i></button>
				  </div>
				</div>
				
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<?php
									print_form($search_form,true,array(2,10));
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type=submit class="btn btn-primary pull-left" value='Submit'>
							</div>
						</div>
												
					</div>
				</div>
				
			</div>
		</form>
		
	</div>
</div>
