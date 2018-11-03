<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script src='<?php echo base_url()."assets"; ?>/dist/js/autoNumeric.min.js'></script>
<script>	
	$(document).ready(function(){
		$('.currency').autoNumeric('init',{aSep:'.', aDec:',', vMin:'0', mDec:0});
	});
	
	$(document).ready(function(){
		$('#delete_confirm').click(function(){
			var ini=$(this);
			ini.hide();
			ini.siblings().show('fast');
		});
	});
	
	$(document).ready(function(){
		$('#cancel_delete').click(function(){
			var ini=$(this).parent().parent();
			ini.hide();
			ini.siblings().show('fast');
		});
	});
</script>
