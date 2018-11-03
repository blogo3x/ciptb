<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-12">
		
		<form name ="userinput" method="POST" action=<?php echo site_url($this->router->class."/".$this->router->method);?>>
			<div class="box box-default">
				<div class="box-header with-border">
				  <h3 class="box-title">Search Filter</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-chevron-up"></i></button>
				  </div>
				</div>
				
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<?php
									print_form($form_input['namaCatar']);
								?>
							</div>
						</div>
												
						<div class="col-md-4">
							<div class="form-group">
								<?php
									print_form($form_input['noDaftCatar']);
								?>
							</div>
						</div>
												
						<div class="col-md-4">
							<div class="form-group">
								<?php
									print_form($form_input['prodiPilihan']);
								?>
							</div>
						</div>
												
					</div>
					
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<?php
									print_form($form_input['gelombang']);
								?>
							</div>
						</div>
												
						<div class="col-md-3">
							<div class="form-group">
								<?php
									print_form($form_input['status']);
								?>
							</div>
						</div>
												
						<div class="col-md-3">
							<div class="form-group">
								<?php
									print_form($form_input['tahun']);
								?>
							</div>
						</div>
												
						<div class="col-md-3">
							<div class="form-group">
								<?php
									print_form($form_input['jenis_counter']);
								?>
							</div>
						</div>
												
					</div>
				</div>
				
				<div class="box-footer clearfix">
					<a href=<?php echo site_url($this->router->class); ?> class="btn btn-danger pull-left"><i class="fa fa-close"></i> Clear Filter</a>
					<input type=submit class="btn btn-primary pull-right" value='Search'>
				</div>
			</div>
		</form>
		
	</div>
</div>

