<?php defined('BASEPATH') OR exit('No direct script access allowed');?>	

<script>
	function show_modal_details(noDaft,nama){
		var URL_details = <?php echo "'".site_url("listcatar/details")."'"; ?>;
					
		$("#modal-title").html("["+noDaft+"] "+nama);
				
		$.ajax({
			type:"post",
			url: URL_details,
			data:{ noDaft:noDaft},
			success:function(response){
				$("#modal-result").html(response);
			},
			error: function(){
				alert("Invalid!");
			}
		});
	}
	
	$(document).ready(function(){
		$('.show_details').click(function(){
			var ini = $(this);
			var noDaft = ini.data('nodaft');
			var nama = ini.data('nama');
			
			show_modal_details(noDaft,nama);
		});
	});
</script>
