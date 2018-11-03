<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>
	
	$(document).ready(function(){
		$('input[type=text]').keyup(function(e){
			var upperVal = $(this).val().toUpperCase();
			$(this).val(upperVal);
		});
	});	

	$(document).ready(function(){
		$('.numOnly').keyup(function(e){
			var ini = $(this);
			ini.val(ini.val().replace(/\D/g,''));
		});
	});	

	$(document).ready(function(){
		$('#raportAll').keyup(function(){
			var ini = $(this);
			var nilai = ini.val();
			nilai = nilai.split(" ");
			
			var jmlNilai = 0;
			for(var i=0;i<nilai.length;i++){
				jmlNilai += parseInt(nilai[i]);
			}
			
			var rata = jmlNilai/nilai.length;
			$('#nilaiRaportCatar').val(rata);
		});
	});	
</script>
