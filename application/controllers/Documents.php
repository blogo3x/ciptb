<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class documents extends CI_Controller {	
	public function __construct(){
		parent::__construct();
		$this->load->model('documents_model');
		$this->load->helper('path');
		$this->load->library("pdf");
	}
	
	public function index(){
		
	}
	
	protected function assign_placeholder($html,$details,$tag=array('{','}')){
		foreach($details as $key=>$val){
			$html = str_replace($tag[0].$key.$tag[1],$val,$html);
			//~ echo $key.' => '.$val.'<br>';
		}
		
		return $html;
	}
	
	public function print_surat($id=NULL){
		if($id==NULL){
			redirect('listcatar/main');
			return;
		}		
		$details = $this->documents_model->get_data_surat_panggilan($id);
		
		$details['TGL_SURAT_PANGGILAN'] = convert_date($details['TGL_SURAT_PANGGILAN']);
		$details['BATAS_ANGSURAN_1'] = convert_date($details['BATAS_ANGSURAN_1']);
		$details['BATAS_ANGSURAN_2'] = convert_date($details['BATAS_ANGSURAN_2']);
		$details['BATAS_BAYAR_SEMESTER'] = convert_date($details['BATAS_BAYAR_SEMESTER']);
		$details['BATAS_KONFIRMASI_BAYAR'] = convert_date($details['BATAS_KONFIRMASI_BAYAR']);
		
		$details['TOTAL'] = 'Rp '.number_format($details['TOTAL'],0,',','.').',-';		
		$details['BIAYA_SEMESTER'] = 'Rp '.number_format($details['BIAYA_SEMESTER'],0,',','.').',-';		
		
		$html = $this->load->view('documents/html_templates/surat_gelombang_1','',true);		
		$html = $this->assign_placeholder($html,$details);
		
		$html = str_replace("{PERNYATAAN_ASRAMA_PUTRI}",
							($details['JK']=='P')?('<li>Setelah heregristrasi Calon Taruni wajib konfirmasi sms ke bagian asrama 082220541396 untuk memastikan kategori pilihan asrama putri yang diinginkan dan melaksanakan kewajiban pembayaran uang asramanya.</li>'):(''),
							$html);
		
		$html = str_replace("{KHUSUS_GEL_3}",
							($details['GEL_ANGKA']!='3')?('dan diberikan kesempatan masuk ke gelombang berikutnya dengan konfirmasi kepada Panitia Penerimaan Taruna/i Baru. Semua bentuk pembayaran tidak diperbolehkan melalui counter/perorangan, info lebih lanjut bisa menghubungi kontak resmi panitia Penerimaan Taruna/i Baru'):(''),
							$html);
		//~ die($html);
		$mpdf = $this->pdf->load('c',array(216,356),'','BookmanOldStyle',18,18,0,0,0,0);
		
		$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins (1 or 0)
		$mpdf->SetDisplayMode('fullpage','two');
		$mpdf->list_indent_default='0px';
		$mpdf->debugfonts=true;
		$mpdf->SetTitle($title);
		//~ $mpdf->setProtection(array('print-highres','print'));

		// LOAD a stylesheet
		$stylesheet = file_get_contents(base_url()."assets/dist/css/printstyle.css");
		$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$mpdf->WriteHTML($html);
		$mpdf->Output($title,"I");
	}
	
	public function formulir_catar($id=NULL){
		if($id==NULL){
			redirect('listcatar/main');
			return;
		}		
		
		$checkbox = array('1'=>"\u9746\'3f", '0'=>"\u9744\'3f");
		
		$details = $this->documents_model->get_data_formulir($id);
		$details['TTL'] = $details['TEMPAT_LAHIR'].', '.convert_date($details['TANGGAL_LAHIR']);
		$details['JK_L'] = $checkbox[$details['JK_L']];
		$details['JK_P'] = $checkbox[$details['JK_P']];
		$details['TAHUN_PTB'] = $_SESSION['tahun_akademik'];
		$details['TGL_CETAK'] = convert_date(time());
		
		for($i=1;$i<=7;$i++)
			$details['c'.$i] = $checkbox[$details['c'.$i]];
		
		//~ var_dump($details);
		$rtf = $this->load->view('documents/html_templates/cetak_form.rtf','',true);
		$rtf = $this->assign_placeholder($rtf,$details,array('[',']'));
		
		$filename = $id."_".date("Y-m-d").".rtf";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$filename");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $rtf;
	}
}
