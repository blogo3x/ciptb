<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class counter extends CI_Controller {
	protected $form_items = array(	
						'jenisCounter' => array(
									'column_name' => 'cntrJenisCounter',
									'type' => 'select',
									'label' => 'Jenis Counter <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'jenisCounter',
										'id' => 'jenisCounter',
										'class' => 'form-control',
										'required' => 'required',
									),
									'options' => array(),
									'selected' => '',
						),
						'namaCounter' => array(
									'column_name' => 'cntrNama',
									'type' => 'input',
									'label' => 'Nama Lengkap <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'namaCounter',
										'id' => 'namaCounter',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
						'tempatLahirCounter' => array(
									'column_name' => 'cntrTempatLahir',
									'type' => 'input',
									'label' => 'Tempat Lahir <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'tempatLahirCounter',
										'id' => 'tempatLahirCounter',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
						'tanggalLahirCounter' => array(
									'column_name' => 'cntrTglLahir',
									'type' => 'input',
									'label' => 'Tanggal Lahir <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'tanggalLahirCounter',
										'id' => 'tanggalLahirCounter',
										'class' => 'form-control datepicker',
										'value' => '',
										'required' => 'required',
									)
						),
						'JKCounter' => array(
									'column_name' => 'cntrJK',
									'type' => 'select',
									'label' => 'Jenis Kelamin <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'JKCounter',
										'id' => 'JKCounter',
										'class' => 'form-control',
									),
									'options' => array(
										'' => '[KOSONG]',
										'P' => 'Perempuan',
										'L' => 'Laki-Laki',
									),
									'selected' => ''
						),
						'agamaCounter' => array(
									'column_name' => 'cntrAgama',
									'type' => 'select',
									'label' => 'Agama <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'agamaCounter',
										'id' => 'agamaCounter',
										'class' => 'form-control',
									),
									'options' => array(),
									'selected' => ''
						),
						'alamatCounter' => array(
									'column_name' => 'cntrAlamat',
									'type' => 'input',
									'label' => 'Alamat <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'alamatCounter',
										'id' => 'alamatCounter',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									),
						),
						'kecamatanCounter' => array(
									'column_name' => 'cntrKecamatan',
									'type' => 'input',
									'label' => 'Kecamatan',
									'attr' => array(
										'name' => 'kecamatanCounter',
										'id' => 'kecamatanCounter',
										'class' => 'form-control',
										'value' => ''
									),
						),
						'kabupatenCounter' => array(
									'column_name' => 'cntrKabupaten',
									'type' => 'input',
									'label' => 'Kabupaten',
									'attr' => array(
										'name' => 'kabupatenCounter',
										'id' => 'kabupatenCounter',
										'class' => 'form-control',
										'value' => ''
									),
						),
						'provinsiCounter' => array(
									'column_name' => 'cntrProvinsi',
									'type' => 'select',
									'label' => 'Provinsi',
									'attr' => array(
										'name' => 'provinsiCounter',
										'id' => 'provinsiCounter',
										'class' => 'form-control',
									),
									'options' => array(),
									'selected' => '',
						),
						'telpCounter' => array(
									'column_name' => 'cntrNoTelp',
									'type' => 'input',
									'label' => 'No Telp <span style="color:red;">*</span>',								
									'attr' => array(
										'name' => 'telpCounter',
										'id' => 'telpCounter',
										'class' => 'form-control numOnly',
										'value' => '',
										'required' => 'required',
									)
						),
						
						'namaInstansiCounter' => array(
									'column_name' => 'cntrInstansiNama',
									'type' => 'input',
									'label' => 'Nama Instansi',
									'attr' => array(
										'name' => 'namaInstansiCounter',
										'id' => 'namaInstansiCounter',
										'class' => 'form-control',
										'value' => '',
									),
						),
						'jabatanInstansiCounter' => array(
									'column_name' => 'cntrInstansiJabatan',
									'type' => 'input',
									'label' => 'Jabatan',
									'attr' => array(
										'name' => 'jabatanInstansiCounter',
										'id' => 'jabatanInstansiCounter',
										'class' => 'form-control',
										'value' => '',
									),
						),
						'alamatInstansiCounter' => array(
									'column_name' => 'cntrInstansiAlamat',
									'type' => 'input',
									'label' => 'Alamat Instansi',
									'attr' => array(
										'name' => 'alamatInstansiCounter',
										'id' => 'alamatInstansiCounter',
										'class' => 'form-control',
										'value' => '',
									),
						),
						'kecamatanInstansiCounter' => array(
									'column_name' => 'cntrInstansiKecamatan',
									'type' => 'input',
									'label' => 'Kecamatan Instansi',
									'attr' => array(
										'name' => 'kecamatanInstansiCounter',
										'id' => 'kecamatanInstansiCounter',
										'class' => 'form-control',
										'value' => ''
									),
						),
						'kabupatenInstansiCounter' => array(
									'column_name' => 'cntrInstansiKabupaten',
									'type' => 'input',
									'label' => 'Kabupaten Instansi',
									'attr' => array(
										'name' => 'kabupatenInstansiCounter',
										'id' => 'kabupatenInstansiCounter',
										'class' => 'form-control',
										'value' => ''
									),
						),
						'telpInstansiCounter' => array(
									'column_name' => 'cntrInstansiNoTelp',
									'type' => 'input',
									'label' => 'No Telp Instansi',								
									'attr' => array(
										'name' => 'telpInstansiCounter',
										'id' => 'telpInstansiCounter',
										'class' => 'form-control numOnly',
										'value' => '',
									)
						),
						'rekBankCounter' => array(
									'column_name' => 'cntrRekBank',
									'type' => 'input',
									'label' => 'Nama Bank <span style="color:red;">*</span>',								
									'attr' => array(
										'name' => 'rekBankCounter',
										'id' => 'rekBankCounter',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
						'rekNomorCounter' => array(
									'column_name' => 'cntrRekNomor',
									'type' => 'input',
									'label' => 'No Rekening <span style="color:red;">*</span>',								
									'attr' => array(
										'name' => 'rekNomorCounter',
										'id' => 'rekNomorCounter',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
						'rekAtasNamaCounter' => array(
									'column_name' => 'cntrRekAtasNama',
									'type' => 'input',
									'label' => 'Atas Nama <span style="color:red;">*</span>',								
									'attr' => array(
										'name' => 'rekAtasNamaCounter',
										'id' => 'rekAtasNamaCounter',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
					);
	public function __construct(){
		parent::__construct();
		$this->load->model('counter_model');
		
		$this->load->library("pagination");
		$this->load->library("blo_table");
		$this->load->library("blo_search");
		
		//updating form with value form table		
		$list_for_form = $this->counter_model->get_grouped_values('namaProvinsi',"ptb_provinsi",true);
		update_value_array($this->form_items,'provinsiCounter->options',$list_for_form);		
				
		$list_for_form = $this->counter_model->get_grouped_values('counter',"ptb_counter",true);
		update_value_array($this->form_items,'jenisCounter->options',$list_for_form);		
				
		$list_for_form = $this->counter_model->get_grouped_values('agama',"ptb_agama",true);
		update_value_array($this->form_items,'agamaCounter->options',$list_for_form);		
		//-------------------------------
		
		$this->counter_model->init($this->form_items);
	}
	
	public function add(){
		
		$data['list'] = $this->counter_model->get_current_form();
		
		$data['title'] = "Tambah Data Counter Baru";		
		$data['subtitle'] = "Kolom bertanda (<span style='color:red'>*</span>) wajib diisi";	
		
		$data['controller'] = $this->router->class;
		$data['method'] = $this->router->method;
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
		
		$this->load->view('counter/form',$data);
		
		$this->load->view('templates/footer');
	}
}
