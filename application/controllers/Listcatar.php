<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class listcatar extends CI_Controller {
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
								'column_name' => 'noDaft',
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
					'gelombang' => array(
								'column_name' => 'gelombang',
								'type' => 'select',
								'label' => 'Gelombang',
								'attr' => array(
									'name' => 'gelombang',
									'id' => 'gelombang',
									'class' => 'form-control',
								),
								'options' => array(
									'' => 'SEMUA',
									'1' => '1',
									'2' => '2',
									'3' => '3',
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
					'tahun' => array(
								'column_name' => 'tahun',
								'type' => 'select',
								'label' => 'Tahun PTB',
								'attr' => array(
									'name' => 'tahun',
									'id' => 'tahun',
									'class' => 'form-control',
								),
								'options' => array(),
								'selected' => ''
					),
					'jenis_counter' => array(
								'column_name' => 'jenisCounter',
								'type' => 'select',
								'label' => 'Jenis Counter',
								'attr' => array(
									'name' => 'jenis_counter',
									'id' => 'jenis_counter',
									'class' => 'form-control',
								),
								'options' => array(),
								'selected' => ''
					),
				);							
								
	public function __construct()
	{
		parent::__construct();
		$this->load->model('listcatar_model');
		//~ $this->load->helper('url_helper'); 
		
		$this->load->library("pagination");
		$this->load->library("blo_table");
		$this->load->library("blo_search");
		
		//setting up the search forms
		$listJenisCounter = $this->listcatar_model->get_grouped_values('jenisCounter');
		$listJenisCounter['-']= "TANPA COUNTER";
		$this->blo_search->update_value($this->search_form,'jenis_counter->options',$listJenisCounter);
		$this->blo_search->update_value($this->search_form,'jenis_counter->selected','');
		
		$listTahun = $this->listcatar_model->get_grouped_values('tahun');
		$this->blo_search->update_value($this->search_form,'tahun->options',$listTahun);
		$this->blo_search->update_value($this->search_form,'tahun->selected',$_SESSION['tahun_aktif']);
		
	}

	public function index()
	{			
		unset($_SESSION['class']);
		redirect(base_url().$this->router->class."/main");
		//~ $this->view();
	}
	
	public function main($start=0,$limit=0)
	{
		$this->blo_search->init($this->search_form,$this->input->post());
			//~ $this->blo_search->search($this->input->post());
		
		$this->search_form = $this->blo_search->get_current_form();
		
		//~ var_dump($this->input->post());
		//~ echo $this->router->directory;
		//~ echo "<br>".$this->router->class;
		//~ echo "<br>".$this->router->method;
		
		$data['form_input'] = $this->search_form;			
		$data['content'] = $this->listcatar_model->get_listcatar($start,$limit);
		
		//~ var_dump($data['content']);
		
		$this->blo_table->init($this->listcatar_model->get_num_rows());
		$this->blo_table->set_heading(array(
										"NO",
										"AKSI",
										"NO DAFTAR",
										"STATUS",
										"GEL.",
										"NAMA",
										"PILIHAN-1",
										"JK",
										"AGAMA",
										"ALAMAT",
										"PROVINSI",
										"ASAL SEKOLAH",
										"NO TELP",
										"COUNTER",
										"CATATAN",
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
		
		$this->load->view('listcatar/index', $data);
		$this->load->view('templates/table', $data);
		$this->load->view('listcatar/modal_catar_details', $data);
		$this->load->view('listcatar/listcatar_js',$data);
		
		$this->load->view('templates/footer');
	}
	
	public function details($id=NULL)
	{	
		global $status;
		global $jurusan_sekolah;
							
		$JK	= array('P'=>'Perempuan', 'L'=>'Laki-Laki');
		$prodi = array(
					'' => "-",
					'D3 AE' => "D3 AERONAUTIKA",
					'D3 MTU' => "D3 MANAJEMEN TRANSPORTASI",
					'D4 MTU' => "D4 MANAJEMEN TRANSPORTASI UDARA",
					'S1 TD' => "S1 TEKNIK DIRGANTARA",
					'D1 PA' => "D1 PRAMUGARI/A",
					'D1 GH' => "D1 GROUND HANDLING",
				);
					
		// for detailed info of selected catars
		if(empty($_POST))
			die();
			
		$noDaft = $_POST['noDaft'];			
		$details = $this->listcatar_model->get_details($noDaft);
		
		//~ echo "<pre>";
		//~ print_r($details);
		//~ echo "</pre>";			
		
		$details_item['list'] = array(
					'status' => array(
								'type' => 'label',
								'label' => 'Status Herreg',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => ($details['tglAktif']>0)?($status[1]):($status[0])
					),
					'tanggal_aktif' => array(
								'type' => 'label',
								'label' => 'Tanggal Herreg',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => ($details['tglAktif']>0)?(convert_date($details['tglAktif'],TRUE)):("-")
					),
					'noDaft' => array(
								'type' => 'label',
								'label' => 'No Pendaftaran',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['noDaft']
					),
					'gelombang' => array(
								'type' => 'label',
								'label' => 'Gelombang',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['gelombang']
					),
					'nama' => array(
								'type' => 'label',
								'label' => 'Nama',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['nama']
					),
					'ttl' => array(
								'type' => 'label',
								'label' => 'Tempat Tanggal Lahir',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['tempatLahir'].", ".strtoupper(convert_date($details['tglLahir']))
					),
					'JK' => array(
								'type' => 'label',
								'label' => 'Jenis Kelamin',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $JK[$details['JK']]
					),
					'agama' => array(
								'type' => 'label',
								'label' => 'Agama',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['agama']
					),
											
					'pil1' => array(
								'type' => 'label',
								'label' => 'Pilihan 1',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $prodi[$details['pil1']]
					),
					
					'pil2' => array(
								'type' => 'label',
								'label' => 'Pilihan 2',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $prodi[$details['pil2']]
					),
					
					'pil3' => array(
								'type' => 'label',
								'label' => 'Pilihan 3',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $prodi[$details['pil3']]
					),						
					
					'alamat' => array(
								'type' => 'label',
								'label' => 'Alamat',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['alamat']
					),
					
					'noTelp' => array(
								'type' => 'label',
								'label' => 'No Telp',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['noTelp']
					),
					
					'kelurahan' => array(
								'type' => 'label',
								'label' => 'Kelurahan',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['aKelurahan']
					),
					
					'kecamatan' => array(
								'type' => 'label',
								'label' => 'Kecamatan',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['aKecamatan']
					),
					
					'kabupaten' => array(
								'type' => 'label',
								'label' => 'Kabupaten',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['aKabupaten']
					),
					
					'provinsi' => array(
								'type' => 'label',
								'label' => 'Provinsi',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['provinsi']
					),
										
					'asalSekolah' => array(
								'type' => 'label',
								'label' => 'Asal Sekolah',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['asalSekolah']
					),
					
					'jurusanSekolah' => array(
								'type' => 'label',
								'label' => 'Jurusan Sekolah',
								'attr' => array(
									'id' => 'keterangan_jurusan',
									'class' => 'form-control',
								),
								'text' => $jurusan_sekolah[$details['jurusanSekolah']].((strlen($details['ketJurusanSekolah'])>0)?(' ('.$details['ketJurusanSekolah'].')'):(''))
					),
										
					'alamatSekolah' => array(
								'type' => 'label',
								'label' => 'Alamat Sekolah',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['alamatSekolah']
					),
					
					'tahunLulus' => array(
								'type' => 'label',
								'label' => 'Tahun Lulus SMA/SMK',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['tahunLulus']
					),
					
					'namaAyah' => array(
								'type' => 'label',
								'label' => 'Nama Ayah',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['namaAyah']
					),
					
					'namaIbu' => array(
								'type' => 'label',
								'label' => 'Nama Ibu',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['namaIbu']
					),
					
					'pekerjaanAyah' => array(
								'type' => 'label',
								'label' => 'Pekerjaan Ayah',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['pekerjaanAyah']
					),
					
					'tinggiBadan' => array(
								'type' => 'label',
								'label' => 'Tinggi Badan',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['tinggiBadan'].' cm'
					),
					
					'beratBadan' => array(
								'type' => 'label',
								'label' => 'Berat Badan',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['beratBadan'].' kg'
					),
					
					'foto3x4' => array(
								'type' => 'label',
								'label' => 'Foto 3x4',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $status[$details['foto3x4']]
					),						
					
					'fotoPostcard' => array(
								'type' => 'label',
								'label' => 'Foto Postcard',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $status[$details['fotoPostcard']]
					),
					
					'SKSehat' => array(
								'type' => 'label',
								'label' => 'S.Ket. Sehat',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $status[$details['SKSehat']]
					),
					
					'akteLahir' => array(
								'type' => 'label',
								'label' => 'Akte Lahir',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $status[$details['akteLahir']]
					),
					
					'raport' => array(
								'type' => 'label',
								'label' => 'Raport',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $status[$details['raport']]
					),
					
					'ijazah' => array(
								'type' => 'label',
								'label' => 'Ijazah',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $status[$details['ijazah']]
					),
					
					'SKCK' => array(
								'type' => 'label',
								'label' => 'SKCK',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $status[$details['SKCK']]
					),
					
					'Counter' => array(
								'type' => 'label',
								'label' => 'Counter',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['jenisCounter'].' - '.$details['counter']
					),
					
					'asrama' => array(
								'type' => 'label',
								'label' => 'Asrama',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['asrama']
					),
					
					'suratPanggilan' => array(
								'type' => 'label',
								'label' => 'Surat Panggilan',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['suratPanggilan']
					),
					
					'kwitansiDaftar' => array(
								'type' => 'label',
								'label' => 'Kwitansi Pendaftaran',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['kwitansiDaftar']
					),
					
					'idHerregSurat' => array(
								'type' => 'label',
								'label' => 'ID Surat Herreg',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['idHerregSurat']
					),
					
					'tglSuratPanggilan' => array(
								'type' => 'label',
								'label' => 'Tanggal Surat Panggilan',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => convert_date($details['tglSuratPanggilan'])
					),
					
					'Biaya' => array(
								'type' => 'label',
								'label' => 'Biaya',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['biaya']
					),
											
					'kirimSurat' => array(
								'type' => 'label',
								'label' => 'Pengiriman Surat',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['kirimSurat']
					),
											
					'nilaiRaport' => array(
								'type' => 'label',
								'label' => 'Nilai Raport',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['nilaiRaport']
					),
											
					'nilaiTKD' => array(
								'type' => 'label',
								'label' => 'Nilai TKD',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['nilaiTKD']
					),
											
					'nilaiPsiko' => array(
								'type' => 'label',
								'label' => 'Nilai Psiko',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['nilaiPsiko']
					),
											
					'kirimSurat' => array(
								'type' => 'label',
								'label' => 'Pengiriman Surat',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['kirimSurat']
					),
					
					'catatan' => array(
								'type' => 'label',
								'label' => 'Catatan',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['catatan']
					),
					
					'petugas' => array(
								'type' => 'label',
								'label' => 'Petugas Entry',
								'attr' => array(
									'id' => 'nama',
									'class' => 'form-control',
								),
								'text' => $details['petugas'].' ('.convert_date($details['timestamp'],1).')'
					),
				);
				
		$details_item['noDaft'] = $details['noDaft'];	
		$details_item['isAlreadySuratPanggilan'] = ($details['tglSuratPanggilan']>0)?(true):(false);	
		
		$this->load->view('listcatar/details',$details_item);
	}
}
