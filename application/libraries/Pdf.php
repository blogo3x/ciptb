<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class pdf {
	function pdf(){
		$CI = & get_instance();
	}

	function load($mode='c', $format='Letter', $fonSize='', $font_family='', $margin_left=0, $margin_right=0, $margin_top=0, $margin_bottom=0, $margin_header=0, $margin_bottom=0, $orientation='P'){

		include_once APPPATH.'/third_party/mpdf/mpdf.php';
		return new mPDF($mode,$format,$fonSize,$font_family,$margin_left,$margin_right,$margin_top,$margin_bottom,$margin_header,$margin_bottom,$orientation);
	}
}

