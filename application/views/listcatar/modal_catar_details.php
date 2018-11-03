<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal fade <?php echo (isset($target)?($target):("modal-target")); ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true"><i class="fa fa-fw fa-close"></i></span></button>
				<h4 id="modal-title" class="modal-title">Title</h4>
			</div>
			<div class="modal-body" id="modal-result">
				<p>One fine body…</p>
			</div>
		</div>
	</div>
</div>
