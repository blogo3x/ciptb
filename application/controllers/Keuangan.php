<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class keuangan extends CI_Controller {
	protected $search_form = array(
					'namaCatar' => array(
								'column_name' => 'nama',
								'type' => 'input',
								'label' => 'Nama Calon Taruna',
								'attr' => array(
									'name' => 'namaCatar',
									'id' => 'namaCatar',
									'class' => 'form-control',
									'value' => ''
								)
					),
					'noDaftCatar' => array(
								'column_name' => 'aa.noDaft',
								'type' => 'input',
								'label' => 'No Daftar',
								'attr' => array(
									'name' => 'noDaftCatar',
									'id' => 'noDaftCatar',
									'class' => 'form-control',
									'value' => ''
								)
					),
					'prodiPilihan' => array(
								'column_name' => 'pil1',
								'type' => 'select',
								'label' => 'Prodi Pilihan 1',
								'attr' => array(
									'name' => 'prodiPilihan',
									'id' => 'prodiPilihan',
									'class' => 'form-control',
								),
								'options' => array(
									'' => 'SEMUA',
									'D3 AE' => 'D3 AERONAUTIKA',
									'D3 MTU' => 'D3 MANAJEMEN TRANSPORTASI',
									'D4 MTU' => 'D4 MANAJEMEN TRANSPORTASI UDARA',
									'S1 TD' => 'S1 TEKNIK DIRGANTARA',
									'D1 GH' => 'D1 GROUND HANDLING',
									'D1 PA' => 'D1 PRAMUGARI',
								),
								'selected' => ''
					),
					'status' => array(
								'column_name' => 'isActive',
								'type' => 'select',
								'label' => 'Status Herregistrasi',
								'attr' => array(
									'name' => 'status',
									'id' => 'status',
									'class' => 'form-control',
								),
								'options' => array(
									'' => 'SEMUA',
									'1' => 'SUDAH',
									'0' => 'BELUM',
								),
								'selected' => ''
					),
				);
				
	protected $keuangan_items =array(
					'status' => array(
								'column_name' => 'status',
								'type' => 'label',
								'label' => 'Status',
								'attr' => array(
									'name' => 'status',
									'id' => 'status',
									'class' => 'form-control',
								),
								'text' => ''
					),
					'tanggal_aktif' => array(
								'column_name' => 'tglAktif',
								'type' => 'label',
								'label' => 'Tanggal Herreg',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => ''
					),
					'noDaft' => array(
								'column_name' => 'noDaft',
								'type' => 'label',
								'label' => 'No Pendaftaran',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => ''
					),
					'prodi' => array(
								'column_name' => 'pil1',
								'type' => 'label',
								'label' => 'Prodi Pilihan 1',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => ''
					),
					'gelombang' => array(
								'column_name' => 'gelombang',
								'type' => 'label',
								'label' => 'Gelombang',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => ''
					),
					'nama' => array(
								'column_name' => 'nama',
								'type' => 'label',
								'label' => 'Nama',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => ''
					),
					
					'tglBayarMasukKeuangan' => array(
								'column_name' => 'tglBayarMasuk',
								'type' => 'input',
								'label' => 'Tanggal Bayar <span style="color:red;">*</span>',									
								'attr' => array(
									'name' => 'tglBayarMasukKeuangan',
									'id' => 'tglBayarMasukKeuangan',
									'class' => 'form-control datepicker',
									'value' => '',
									'required' => 'required'
								)
					),
					'jumlahBayarMasukKeuangan' => array(
								'column_name' => 'jumlahBayarMasuk',
								'type' => 'input',
								'label' => 'Jumlah Bayar',									
								'attr' => array(
									'name' => 'jumlahBayarMasukKeuangan',
									'id' => 'jumlahBayarMasukKeuangan',
									'class' => 'form-control currency',
									'value' => ''
								)
					),
					'catatanMasukKeuangan' => array(
								'column_name' => 'catatanMasuk',
								'type' => 'input',
								'label' => 'Catatan',									
								'attr' => array(
									'name' => 'catatanMasukKeuangan',
									'id' => 'catatanMasukKeuangan',
									'class' => 'form-control',
									'value' => ''
								)
					),
					
					'tglBayarSPPKeuangan' => array(
								'column_name' => 'tglBayarSPP',
								'type' => 'input',
								'label' => 'Tanggal Bayar',									
								'attr' => array(
									'name' => 'tglBayarSPPKeuangan',
									'id' => 'tglBayarSPPKeuangan',
									'class' => 'form-control datepicker',
									'value' => ''
								)
					),
					'jumlahBayarSPPKeuangan' => array(
								'column_name' => 'jumlahBayarSPP',
								'type' => 'input',
								'label' => 'Jumlah Bayar',									
								'attr' => array(
									'name' => 'jumlahBayarSPPKeuangan',
									'id' => 'jumlahBayarSPPKeuangan',
									'class' => 'form-control currency',
									'value' => ''
								)
					),
					'catatanSPPKeuangan' => array(
								'column_name' => 'catatanSPP',
								'type' => 'input',
								'label' => 'Catatan',									
								'attr' => array(
									'name' => 'catatanSPPKeuangan',
									'id' => 'catatanSPPKeuangan',
									'class' => 'form-control',
									'value' => ''
								)
					),
					
					'tglBayarAsramaKeuangan' => array(
								'column_name' => 'tglBayarAsrama',
								'type' => 'input',
								'label' => 'Tanggal Bayar',									
								'attr' => array(
									'name' => 'tglBayarAsramaKeuangan',
									'id' => 'tglBayarAsramaKeuangan',
									'class' => 'form-control datepicker',
									'value' => ''
								)
					),
					'jumlahBayarAsramaKeuangan' => array(
								'column_name' => 'jumlahBayarAsrama',
								'type' => 'input',
								'label' => 'Jumlah Bayar',									
								'attr' => array(
									'name' => 'jumlahBayarAsramaKeuangan',
									'id' => 'jumlahBayarAsramaKeuangan',
									'class' => 'form-control currency',
									'value' => ''
								)
					),
					'catatanAsramaKeuangan' => array(
								'column_name' => 'catatanAsrama',
								'type' => 'input',
								'label' => 'Catatan',									
								'attr' => array(
									'name' => 'catatanAsramaKeuangan',
									'id' => 'catatanAsramaKeuangan',
									'class' => 'form-control',
									'value' => ''
								)
					),
					'tglAktifKeuangan' => array(
								'column_name' => 'tglAktif',
								'type' => 'input',
								'label' => 'Tanggal Aktif',									
								'attr' => array(
									'name' => 'tglAktifKeuangan',
									'id' => 'tglAktifKeuangan',
									'class' => 'form-control datepicker',
									'value' => ''
								)
					),
				);
	
	public function __construct(){
		parent::__construct();
		$this->load->model('keuangan_model');
		
		$this->load->library("pagination");
		$this->load->library("blo_table");
		$this->load->library("blo_search");
	}

	public function index()
	{			
		unset($_SESSION['class']);
		redirect(site_url($this->router->class.'/main'));
		//~ $this->view();
	}
	
	public function main($start=0){
		$this->blo_search->init($this->search_form,$this->input->post());
		
		$this->search_form = $this->blo_search->get_current_form();
		
		$data['form_input'] = $this->search_form;			
		$data['content'] = $this->keuangan_model->get_listcatar($start);
		
		$this->blo_table->init($this->keuangan_model->get_num_rows());
		$this->blo_table->set_heading(array(
										"NO",
										"AKSI",
										"NO DAFTAR",
										"NAMA",
										"TANGGAL AKTIF",
										"GEL.",
										"PILIHAN-1",
										"JENIS KELAMIN",
										"UANG MASUK",
										"SPP",
										"ASRAMA"
									));
		
		$data['title'] = 'List Calon Taruna';
		$data['subtitle'] = 'Tahun Aktif PTB '.$_SESSION['tahun_aktif'];
					
		$data['controller'] = $this->router->class;
		$data['method'] = $this->router->method;
		
		$data['table']=$this->blo_table->generate($data['content']);
		$data['pagination']=$this->blo_table->pagination_link();
		$data['total_rows']=$this->blo_table->get_total_rows();
		$data['current_rows']=$this->blo_table->get_range_rows($start);
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
		
		$this->load->view('keuangan/index', $data);
		$this->load->view('templates/table', $data);
		
		$this->load->view('templates/footer');
	}
	
	public function registration($id=NULL){
		global $status;
		global $prodi;
		
		if($id==NULL){
			redirect(site_url($this->router->class.'/main'));
		}
							
		$this->keuangan_model->init($this->keuangan_items);
		$details = $this->keuangan_model->get_details($id);
		$this->keuangan_model->set_form_value_from_db($details,true);
		
		$data['list'] = $this->keuangan_model->get_current_form();
		//~ echo "<pre>";
		//~ var_dump($details);
		//~ echo "</pre>";
		
		//~ echo "<pre>";
		//~ var_dump($data['list']);
		//~ echo "</pre>";
		//~ die();
				
		$data['title'] = $details['noDaft'].' '.$details['nama'];
		$data['subtitle'] = ($details['status'])?('Herregistrasi : '.convert_date($details['tglAktif'],true)):('BELUM HERREGISTRASI');
		
		$data['controller'] = $this->router->class;
		$data['method'] = $this->router->method;
		
		$data['noDaft'] = $details['noDaft'];
		$data['status'] = $details['status'];
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
		
		$this->load->view('keuangan/registration', $data);
		$this->load->view('keuangan/keuangan_js', $data);
		
		$this->load->view('templates/footer');
	}
	
	public function update($id=NULL){
		if($id==NULL || empty($_POST)){
			redirect(site_url($this->router->class.'/main'));
			return;
		}
		
		//just to make sure, POST isn't empty
		if(!empty($_POST) && $id!=NULL){
			$this->keuangan_model->init($this->keuangan_items);
			
			if($this->keuangan_model->is_already_in($id))
				$action = 'update';
			else
				$action = 'insert';
				
			$this->keuangan_model->insert_update_db($id,$this->input->post(),$action);	
			redirect(site_url($this->router->class.'/main'));
			return;
		}
	}
	
	public function delete($id=NULL){
		if($id==NULL || empty($_POST)){
			redirect(site_url($this->router->class.'/main'));
			return;
		}
		
		//just to make sure, POST isn't empty
		if(!empty($_POST) && $id!=NULL){
			$noDaft = $_POST['data_id'];
			
			if($id != $noDaft){
				redirect($this->router->class."/registration/".$id);
				return;
			}
			
			$this->keuangan_model->delete($id);
										
			redirect(site_url($this->router->class.'/main'));
			return;
		}
	}
}
