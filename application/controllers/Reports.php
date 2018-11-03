<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class reports extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('reports_model');
		$this->load->library("blo_highcharts");
	}
	
	public function index(){
		unset($_SESSION['class']);
		redirect(site_url($this->router->class."/grafik"));
		return;
	}
	
	protected function search_by_tahun_form($tahun=NULL){		
		$search_form = array(
			'search_tahun' => array(
						'type' => 'select',
						'label' => 'Tahun PTB',
						'attr' => array(
							'name' => 'tahun_ptb',
							'id' => 'tahun_ptb',
							'class' => 'form-control',
							'value' => '',
						),
						'options' => array(),
						'selected' => $tahun
				)
		);
		
		$options = $this->reports_model->get_grouped_values('tahun','ptb_dataExcel',false);
		update_value_array($search_form,'search_tahun->options',$options);
		
		return $search_form['search_tahun']; 
	}
			
	public function grafik(){		
		if(!isset($_POST['tahun_ptb']))
			$tahun = $_SESSION['tahun_aktif'];
		else if(isset($_POST['tahun_ptb']))
			$tahun = $_POST['tahun_ptb'];
		
		$total_herregistrasi = $this->reports_model->get_total_herregistrasi($tahun);
		
		//generate chart for each month
		$details = $this->reports_model->get_rekap_bayar_per_bulan($tahun);			
		$id= 'rekap_per_bulan';
		$this->blo_highcharts->init($id);
		$this->blo_highcharts->set_type($id,'column');
		$this->blo_highcharts->set_title($id,'Per Bulan Tahun '.$tahun.' ( Total: '.$total_herregistrasi.' )');
		$this->blo_highcharts->set_y_axis_title($id,"Jumlah Catar");
		$this->blo_highcharts->set_categories($id,$details['categories']);
		$this->blo_highcharts->set_series($id,$details['series'],'Per Bulan');
		$this->blo_highcharts->set_use_tooltips($id,true);
		$this->blo_highcharts->generate_script($id);	
		$data['container'][$id] = $this->blo_highcharts->get_container($id);	
		$data['box_title'][$id] = 'Rekapitulasi PTB Tahun '.$tahun.' (Per Bulan)';	
			
		//generate chart for each prodi and sex
		$details = $this->reports_model->get_rekap_per_prodi($tahun);	
		$id= 'rekap_per_prodi';
		$this->blo_highcharts->init($id);
		$this->blo_highcharts->set_type($id,'column');
		$this->blo_highcharts->set_height($id,555);
		$this->blo_highcharts->set_title($id,'Per Prodi & JK Tahun '.$tahun.' ( Total: '.$total_herregistrasi.' )');
		$this->blo_highcharts->set_y_axis_title($id,"Jumlah Catar");
		$this->blo_highcharts->set_categories($id,$details['categories']);
		$this->blo_highcharts->set_series($id,$details['series']);
		$this->blo_highcharts->set_use_tooltips($id,false);
		$this->blo_highcharts->generate_script($id);	
		$data['container'][$id] = $this->blo_highcharts->get_container($id);
		$data['box_title'][$id] = 'Rekapitulasi PTB Tahun '.$tahun.' (Per Prodi & Jenis Kelamin)';
			
		//generate chart for each gelombang
		$details = $this->reports_model->get_rekap_per_gelombang($tahun);	
		$id= 'rekap_per_gelombang';
		$this->blo_highcharts->init($id);
		$this->blo_highcharts->set_type($id,'column');
		$this->blo_highcharts->set_title($id,'Per Gelombang '.$tahun.' ( Total: '.$total_herregistrasi.' )');
		$this->blo_highcharts->set_y_axis_title($id,"Jumlah Catar");
		$this->blo_highcharts->set_categories($id,$details['categories']);
		$this->blo_highcharts->set_series($id,$details['series'],'Gelombang');
		$this->blo_highcharts->set_use_tooltips($id,true);
		$this->blo_highcharts->generate_script($id);	
		$data['container'][$id] = $this->blo_highcharts->get_container($id);
		$data['box_title'][$id] = 'Rekapitulasi PTB Tahun '.$tahun.' (Per Gelombang)';
			
		//generate chart for each sex
		$details = $this->reports_model->get_rekap_per_JK($tahun);	
		$id= 'rekap_per_kelamin';
		$this->blo_highcharts->init($id);
		$this->blo_highcharts->set_type($id,'column');
		$this->blo_highcharts->set_title($id,'Per Jenis Kelamin '.$tahun.' ( Total: '.$total_herregistrasi.' )');
		$this->blo_highcharts->set_y_axis_title($id,"Jumlah Catar");
		$this->blo_highcharts->set_categories($id,$details['categories']);
		$this->blo_highcharts->set_series($id,$details['series'],'Kelamin');
		$this->blo_highcharts->set_use_tooltips($id,true);
		$this->blo_highcharts->generate_script($id);	
		$data['container'][$id] = $this->blo_highcharts->get_container($id);
		$data['box_title'][$id] = 'Rekapitulasi PTB Tahun '.$tahun.' (Per Kelamin)';
		
		$data['search_form'] = $this->search_by_tahun_form($tahun);
		
		$data['script'] = $this->blo_highcharts->get_all_scripts();	
		$data['title'] = 'Pelaporan Grafik PTB Tahun '.$tahun;	
		$data['chart'] = "highcharts";	
				
		$data['controller'] = $this->router->class;
		$data['method'] = $this->router->method;
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
		
		$this->load->view('reports/search_by_tahun_form', $data);
		$this->load->view('reports/charts', $data);
		
		$this->load->view('templates/footer');
	}
}
