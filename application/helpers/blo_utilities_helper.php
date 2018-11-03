<?php
	defined('BASEPATH') OR exit('No direct script access allowed');				
	
	if(!function_exists('convert_date')){			
		function convert_date($date,$useDayName=0){
			// date format is YYYY-MM-DD
			
			$day = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
			$month = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			
			$dayName = "";
			
			if(is_numeric($date)){
			 //if it's unix timestamp, convert it to YYYY-MM-DD
				if($date<=0)
					return; 
					
				if($useDayName)
					$dayName = $day[(int)date("w",$date)].", ";
					
				$date = date("Y-m-d",$date);
			}
			
			if($date == "0000-00-00")
				return "-";
			
			
			$date = explode("-",$date);
			
			$dateName = (int)$date[2];		
			$monthName = $month[(int)$date[1]];
			$yearName = $date[0];
						
			return $dayName.$dateName." ".$monthName." ".$yearName;
		}
	}
	
	if(!function_exists('print_form')){
		function print_form($identity,$inline=FALSE,$col = array(3,9)){
			$col_left = $col[0];
			$col_right = $col[1];
			
			if($inline === FALSE)
				echo form_label($identity['label'],$identity['attr']['id'],array('class'=>'control-label'));
			else{
				echo form_label($identity['label'],$identity['attr']['id'],array('class'=>'control-label col-md-'.$col_left));
			}
			
			switch($identity['type']){
				case 'input':
					if($inline === FALSE)
						echo form_input($identity['attr']);
					else
						echo "<div class='col-md-".$col_right."'>".form_input($identity['attr'])."</div>";
					break;
					
				case 'select':
					if($inline === FALSE)
						echo form_dropdown($identity['attr']['name'], $identity['options'], $identity['selected'], $identity['attr']);
					else
						echo "<div class='col-md-".$col_right."'>".form_dropdown($identity['attr']['name'], $identity['options'], $identity['selected'], $identity['attr'])."</div>";
					break;
				
				case 'label':
					if($inline === FALSE)
						echo "<p class='form-control-static'>".$identity['text']."</p>";
					else
						echo "<div class='col-md-".$col_right."'><p class='form-control-static'>".$identity['text']."</p></div>";
					break;
					
				default: break;
			}
			
			//~ if($identity['type'] == 'input'){
				//~ echo form_input($identity['attr']);
			//~ }
			//~ else if($identity['type'] == 'select'){
				//~ echo form_dropdown($identity['attr']['name'], $identity['options'], $identity['selected'], $identity['attr']);
			//~ }
		}
	}
	
	if(!function_exists('update_value_array')){
		function update_value_array(&$array, $path, $value=NULL){
			// got from here :
			// https://stackoverflow.com/questions/27929875/how-to-access-and-manipulate-multi-dimensional-array-by-key-names-path
			//
			
			$path = explode('->', $path);
			$temp = &$array;

			foreach($path as $key) {
				$temp = &$temp[$key];
			}
			$temp = $value;
		}
	}
	
	if(!function_exists('get_value_array')){
		function get_value_array($array, $path) {
			// got from here :
			// https://stackoverflow.com/questions/27929875/how-to-access-and-manipulate-multi-dimensional-array-by-key-names-path
			//
			
			$path = explode('->', $path);
			$temp =& $array;

			foreach($path as $key) {
				$temp =& $temp[$key];
			}
			return $temp;
		}
	}
	
	if(!function_exists('unset_array_index')){
		function unset_array_index(&$array,$path) {
			// got from here :
			// https://stackoverflow.com/questions/27929875/how-to-access-and-manipulate-multi-dimensional-array-by-key-names-path
			//
			
			$path = explode('->', $path);
			$temp =& $array;
			
			$depth = sizeof($path)-1;
			$cnt=0;
			foreach($path as $key) {
				if($cnt++>=$depth) {
					unset($temp[$key]);
				} else {
					$temp =& $temp[$key];
				}
			}
		}
	}
	
	if(!function_exists('toRoman')){
		function toRoman($N){
			$c='IVXLCDM';
			for($a=5,$b=$s='';$N;$b++,$a^=7)
					for($o=$N%$a,$N=$N/$a^0;$o--;$s=$c[$o>2?$b+$N-($N&=-2)+$o=1:$b].$s);
			return $s;
		}	
	}
	
	if(!function_exists('is_multidimensional_array')){
		function is_multidimensional_array($array,$return = 'BOOLEAN'){
			if($return == 'BOOLEAN')
				return (count($array,COUNT_RECURSIVE) == count($array))?(false):(true);
			else if($return == 'STRING')
				return (count($array,COUNT_RECURSIVE) == count($array))?('false'):('true');
			else if($return == 'INTEGER')
				return (count($array,COUNT_RECURSIVE) == count($array))?(0):(1);
		}	
	}
	
