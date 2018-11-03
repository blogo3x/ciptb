<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box box-default">
	<div class="box-body">
		<div class='col-md-1'></div>
		<div class='col-md-10'>
			<form class="form-horizontal" name ="add_new_catar" method="POST" action=<?php echo site_url($this->router->class."/".$this->router->method);?>>
			
			<?php
			foreach($list as $key=>$val){?>
				<div class='form-group'>
						<?php echo print_form($val,true,array(2,5)); ?>
				</div>
			<?php } ?>
								
				<div class='form-group'>
					<div class='col-md-2'></div>
					<div class='col-md-5'>
						<input type=submit class="btn btn-block btn-primary pull-right" value='Submit'>
					</div>
					<div class='col-md-5'></div>
					
				</div>
			</form>
		</div>
		<div class='col-md-1'></div>
	</div>
</div>
