<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class addeditdelete extends CI_Controller {
	
	protected $form_items = array(
						'status' => array(
									'column_name' => 'isActive',
									'type' => 'label',
									'label' => 'Status Herreg',
									'attr' => array(
										'id' => 'statusCatar',
										'class' => 'form-control',
									),
									'text' => ''
						),
						'tanggal_aktif' => array(
									'column_name' => 'tglAktif',
									'type' => 'label',
									'label' => 'Tanggal Herreg',
									'attr' => array(
										'id' => 'tanggal_aktif',
										'class' => 'form-control',
									),
									'text' => ''
						),
						'noDaftCatar' => array(
									'column_name' => 'noDaft',
									'type' => 'input',
									'label' => 'No Daftar',
									'attr' => array(
										'name' => 'noDaftCatar',
										'id' => 'noDaftCatar',
										'class' => 'form-control',
										'value' => '',
										'readonly' => 'readonly'
									)
						),
						'gelombang' => array(
									'column_name' => 'gelombang',
									'type' => 'select',
									'label' => 'Gelombang <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'gelombang',
										'id' => 'gelombang',
										'class' => 'form-control',
										'required' => 'required',
									),
									'options' => array(
										'' => '[KOSONG]',
										'1' => '1',
										'2' => '2',
										'3' => '3',
									),
									'selected' => ''
						),
						'namaCatar' => array(
									'column_name' => 'nama',
									'type' => 'input',
									'label' => 'Nama Calon Taruna <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'namaCatar',
										'id' => 'namaCatar',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required'
									)
						),
						'tempatLahirCatar' => array(
									'column_name' => 'tempatLahir',
									'type' => 'input',
									'label' => 'Tempat Lahir <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'tempatLahirCatar',
										'id' => 'tempatLahirCatar',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
						'tanggalLahirCatar' => array(
									'column_name' => 'tglLahir',
									'type' => 'input',
									'label' => 'Tanggal Lahir <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'tanggalLahirCatar',
										'id' => 'tanggalLahirCatar',
										'class' => 'form-control datepicker',
										'value' => '',
										'required' => 'required',
									)
						),
						'JKCatar' => array(
									'column_name' => 'JK',
									'type' => 'select',
									'label' => 'Jenis Kelamin <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'JKCatar',
										'id' => 'JKCatar',
										'class' => 'form-control',
									),
									'options' => array(
										'' => '[KOSONG]',
										'P' => 'Perempuan',
										'L' => 'Laki-Laki',
									),
									'selected' => ''
						),
						'agamaCatar' => array(
									'column_name' => 'agama',
									'type' => 'select',
									'label' => 'Agama <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'agamaCatar',
										'id' => 'agamaCatar',
										'class' => 'form-control',
										'required' => 'required',
									),
									'options' => array(
										'' => '[KOSONG]',
										'ISLAM' => 'ISLAM',
										'KRISTEN' => 'KRISTEN',
										'KATHOLIK' => 'KATHOLIK',
										'HINDU' => 'HINDU',
										'BUDHA' => 'BUDHA',
										'LAINNYA' => 'LAINNYA',
									),
									'selected' => ''
						),
												
						'pilihan1Catar' => array(
									'column_name' => 'pil1',
									'type' => 'select',
									'label' => 'Prodi Pilihan 1 <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'pilihan1Catar',
										'id' => 'pilihan1Catar',
										'class' => 'form-control',
										'required' => 'required',
									),
									'options' => array(
										'' => '[KOSONG]',
										'D3 AE' => 'D3 AERONAUTIKA',
										'D3 MTU' => 'D3 MANAJEMEN TRANSPORTASI',
										'D4 MTU' => 'D4 MANAJEMEN TRANSPORTASI UDARA',
										'S1 TD' => 'S1 TEKNIK DIRGANTARA',
										'D1 GH' => 'D1 GROUND HANDLING',
										'D1 PA' => 'D1 PRAMUGARI',
									),
									'selected' => ''
						),									
												
						'pilihan2Catar' => array(
									'column_name' => 'pil2',
									'type' => 'select',
									'label' => 'Prodi Pilihan 2',
									'attr' => array(
										'name' => 'pilihan2Catar',
										'id' => 'pilihan2Catar',
										'class' => 'form-control',
									),
									'options' => array(
										'' => '[KOSONG]',
										'D3 AE' => 'D3 AERONAUTIKA',
										'D3 MTU' => 'D3 MANAJEMEN TRANSPORTASI',
										'D4 MTU' => 'D4 MANAJEMEN TRANSPORTASI UDARA',
										'S1 TD' => 'S1 TEKNIK DIRGANTARA',
										'D1 GH' => 'D1 GROUND HANDLING',
										'D1 PA' => 'D1 PRAMUGARI',
									),
									'selected' => ''
						),									
												
						'pilihan3Catar' => array(
									'column_name' => 'pil3',
									'type' => 'select',
									'label' => 'Prodi Pilihan 3',
									'attr' => array(
										'name' => 'pilihan3Catar',
										'id' => 'pilihan3Catar',
										'class' => 'form-control',
									),
									'options' => array(
										'' => '[KOSONG]',
										'D3 AE' => 'D3 AERONAUTIKA',
										'D3 MTU' => 'D3 MANAJEMEN TRANSPORTASI',
										'D4 MTU' => 'D4 MANAJEMEN TRANSPORTASI UDARA',
										'S1 TD' => 'S1 TEKNIK DIRGANTARA',
										'D1 GH' => 'D1 GROUND HANDLING',
										'D1 PA' => 'D1 PRAMUGARI',
									),
									'selected' => ''
						),									
						
						'TelpCatar' => array(
									'column_name' => 'noTelp',
									'type' => 'input',
									'label' => 'No Telp',									
									'attr' => array(
										'name' => 'TelpCatar',
										'id' => 'TelpCatar',
										'class' => 'form-control numOnly',
										'value' => ''
									)
						),
						
						'alamatCatar' => array(
									'column_name' => 'alamat',
									'type' => 'input',
									'label' => 'Alamat <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'alamatCatar',
										'id' => 'alamatCatar',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),						
						
						'kelurahanCatar' => array(
									'column_name' => 'aKelurahan',
									'type' => 'input',
									'label' => 'Kelurahan <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'kelurahanCatar',
										'id' => 'kelurahanCatar',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
						
						'kecamatanCatar' => array(
									'column_name' => 'aKecamatan',
									'type' => 'input',
									'label' => 'Kecamatan <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'kecamatanCatar',
										'id' => 'kecamatanCatar',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
						
						'kabupatenCatar' => array(
									'column_name' => 'aKabupaten',
									'type' => 'input',
									'label' => 'Kabupaten <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'kabupatenCatar',
										'id' => 'kabupatenCatar',
										'class' => 'form-control autocomplete',
										'value' => '',
										'required' => 'required',
									)
						),
						
						'provinsiCatar' => array(
									'column_name' => 'provinsi',
									'type' => 'select',
									'label' => 'Provinsi <span style="color:red;">*</span>',
									'attr' => array(
										'name' => 'provinsiCatar',
										'id' => 'provinsiCatar',
										'class' => 'form-control',
										'required' => 'required',
									),
									'options' => array(),
									'selected' => ''
						),
						
						'asalSekolahCatar' => array(
									'column_name' => 'asalSekolah',
									'type' => 'input',
									'label' => 'Asal Sekolah <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'asalSekolahCatar',
										'id' => 'asalSekolahCatar',
										'class' => 'form-control autocomplete',
										'value' => '',
										'required' => 'required',
									)
						),
						
						'alamatSekolahCatar' => array(
									'column_name' => 'alamatSekolah',
									'type' => 'input',
									'label' => 'Alamat Sekolah',									
									'attr' => array(
										'name' => 'alamatSekolahCatar',
										'id' => 'alamatSekolahCatar',
										'class' => 'form-control',
										'value' => ''
									)
						),
						
						'jurusanSekolahCatar' => array(
									'column_name' => 'jurusanSekolah',
									'type' => 'select',
									'label' => 'Jurusan SMTA <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'jurusanSekolahCatar',
										'id' => 'jurusanSekolahCatar',
										'class' => 'form-control numOnly',
										'value' => '',
										'required' => 'required',
									),
									'options' => array(
										'' => '[KOSONG]',
										'IA' => 'ILMU ALAM',
										'IS' => 'ILMU SOSIAL',
										'IB' => 'ILMU BAHASA',
										'SMK' => 'SMK/KEJURUAN',
										'-' => 'LAINNYA',
									),
									'selected' => ''
						),
												
						'keterangan_jurusan' => array(
									'column_name' => 'ketJurusanSekolah',
									'type' => 'input',
									'label' => 'Keterangan Jurusan Sekolah',									
									'attr' => array(
										'name' => 'keterangan_jurusan',
										'id' => 'keterangan_jurusan',
										'class' => 'form-control',
										'placeholder' => 'Tambahan keterangan untuk jurusan SMK',
										'value' => ''
									)
						),
						
						'tahunLulusSekolah' => array(
									'column_name' => 'tahunLulus',
									'type' => 'input',
									'label' => 'Tahun Lulus SMTA <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'tahunLulusSekolah',
										'id' => 'tahunLulusSekolah',
										'class' => 'form-control numOnly',
										'value' => '',
										'required' => 'required',
									)
						),
						
						'namaAyahCatar' => array(
									'column_name' => 'namaAyah',
									'type' => 'input',
									'label' => 'Nama Ayah <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'namaAyahCatar',
										'id' => 'namaAyahCatar',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
						
						'namaIbuCatar' => array(
									'column_name' => 'namaIbu',
									'type' => 'input',
									'label' => 'Nama Ibu <span style="color:red;">*</span>',									
									'attr' => array(
										'name' => 'namaIbuCatar',
										'id' => 'namaIbuCatar',
										'class' => 'form-control',
										'value' => '',
										'required' => 'required',
									)
						),
						
						'pekerjaanAyahCatar' => array(
									'column_name' => 'pekerjaanAyah',
									'type' => 'input',
									'label' => 'Pekerjaan Ayah',									
									'attr' => array(
										'name' => 'pekerjaanAyahCatar',
										'id' => 'pekerjaanAyahCatar',
										'class' => 'form-control',
										'value' => ''
									)
						),
						
						'tinggiBadanCatar' => array(
									'column_name' => 'tinggiBadan',
									'type' => 'input',
									'label' => 'Tinggi Badan',									
									'attr' => array(
										'name' => 'tinggiBadanCatar',
										'id' => 'tinggiBadanCatar',
										'class' => 'form-control numOnly',
										'placeholder' => 'Dalam cm',
										'value' => ''
									)
						),
						
						'beratBadanCatar' => array(
									'column_name' => 'beratBadan',
									'type' => 'input',
									'label' => 'Berat Badan',									
									'attr' => array(
										'name' => 'beratBadanCatar',
										'id' => 'beratBadanCatar',
										'class' => 'form-control numOnly',
										'placeholder' => 'Dalam kg',
										'value' => ''
									)
						),
						
						'foto3x4Catar' => array(
									'column_name' => 'foto3x4',
									'type' => 'select',
									'label' => 'Foto 3x4',
									'attr' => array(
										'name' => 'foto3x4Catar',
										'id' => 'foto3x4Catar',
										'class' => 'form-control',
									),
									'options' => array(
										'0' => 'Tidak',
										'1' => 'Ada',
									),
									'selected' => ''
						),						
						
						'fotoPostcardCatar' => array(
									'column_name' => 'fotoPostcard',
									'type' => 'select',
									'label' => 'Foto Postcard',
									'attr' => array(
										'name' => 'fotoPostcardCatar',
										'id' => 'fotoPostcardCatar',
										'class' => 'form-control',
									),
									'options' => array(
										'0' => 'Tidak',
										'1' => 'Ada',
									),
									'selected' => ''
						),
						
						'SKSehatCatar' => array(
									'column_name' => 'SKSehat',
									'type' => 'select',
									'label' => 'S.Ket Sehat',
									'attr' => array(
										'name' => 'SKSehatCatar',
										'id' => 'SKSehatCatar',
										'class' => 'form-control',
									),
									'options' => array(
										'0' => 'Tidak',
										'1' => 'Ada',
									),
									'selected' => ''
						),
						
						'akteLahirCatar' => array(
									'column_name' => 'akteLahir',
									'type' => 'select',
									'label' => 'Akte Lahir',
									'attr' => array(
										'name' => 'akteLahirCatar',
										'id' => 'akteLahirCatar',
										'class' => 'form-control',
									),
									'options' => array(
										'0' => 'Tidak',
										'1' => 'Ada',
									),
									'selected' => ''
						),
						
						'raportCatar' => array(
									'column_name' => 'raport',
									'type' => 'select',
									'label' => 'Raport',
									'attr' => array(
										'name' => 'raportCatar',
										'id' => 'raportCatar',
										'class' => 'form-control',
									),
									'options' => array(
										'0' => 'Tidak',
										'1' => 'Ada',
									),
									'selected' => ''
						),
						
						'ijazahCatar' => array(
									'column_name' => 'ijazah',
									'type' => 'select',
									'label' => 'Ijazah',
									'attr' => array(
										'name' => 'ijazahCatar',
										'id' => 'ijazahCatar',
										'class' => 'form-control',
									),
									'options' => array(
										'0' => 'Tidak',
										'1' => 'Ada',
									),
									'selected' => ''
						),
						
						'SKCKCatar' => array(
									'column_name' => 'SKCK',
									'type' => 'select',
									'label' => 'SKCK',
									'attr' => array(
										'name' => 'SKCKCatar',
										'id' => 'SKCKCatar',
										'class' => 'form-control',
									),
									'options' => array(
										'0' => 'Tidak',
										'1' => 'Ada',
									),
									'selected' => ''
						),
						
						'jenisCounterCatar' => array(
									'column_name' => 'jenisCounter',
									'type' => 'select',
									'label' => 'Jenis Counter',
									'attr' => array(
										'name' => 'jenisCounterCatar',
										'id' => 'jenisCounterCatar',
										'class' => 'form-control',
									),
									'options' => array(),
									'selected' => ''
						),
						
						'counterCatar' => array(
									'column_name' => 'counter',
									'type' => 'input',
									'label' => 'Counter',									
									'attr' => array(
										'name' => 'counterCatar',
										'id' => 'counterCatar',
										'class' => 'form-control autocomplete',
										'value' => ''
									)
						),
						
						'asramaCatar' => array(
									'column_name' => 'asrama',
									'type' => 'input',
									'label' => 'Asrama',									
									'attr' => array(
										'name' => 'asramaCatar',
										'id' => 'asramaCatar',
										'class' => 'form-control',
										'value' => ''
									)
						),
						
						'suratPanggilanCatar' => array(
									'column_name' => 'suratPanggilan',
									'type' => 'input',
									'label' => 'Surat Panggilan',									
									'attr' => array(
										'name' => 'suratPanggilanCatar',
										'id' => 'suratPanggilanCatar',
										'class' => 'form-control',
										'disabled' => 'disabled',
										'value' => '',
									)
						),
						
						'kwitansiDaftar' => array(
									'column_name' => 'kwitansiDaftar',
									'type' => 'input',
									'label' => 'Kwitansi Pendaftaran',									
									'attr' => array(
										'name' => 'kwitansiDaftarCatar',
										'id' => 'kwitansiDaftarCatar',
										'class' => 'form-control',
										'value' => '',
									)
						),
						
						'idHerregSuratCatar' => array(
									'column_name' => 'idHerregSurat',
									'type' => 'input',
									'label' => 'ID Herregistrasi',									
									'attr' => array(
										'name' => 'idHerregSuratCatar',
										'id' => 'idHerregSuratCatar',
										'class' => 'form-control',
										'disabled' => 'disabled',
										'value' => '',
									)
						),
						
						'tglSuratPanggilanCatar' => array(
									'column_name' => 'tglSuratPanggilan',
									'type' => 'input',
									'label' => 'Tgl. Surat Panggilan',									
									'attr' => array(
										'name' => 'tglSuratPanggilanCatar',
										'id' => 'tglSuratPanggilanCatar',
										'class' => 'form-control datepicker',
										'disabled' => 'disabled',
										'value' => '',
									)
						),
						
						'BiayaCatar' => array(
									'column_name' => 'biaya',
									'type' => 'input',
									'label' => 'Biaya',									
									'attr' => array(
										'name' => 'BiayaCatar',
										'id' => 'BiayaCatar',
										'class' => 'form-control',
										'value' => '',
									)
						),
												
						'kirimSuratCatar' => array(
									'column_name' => 'kirimSurat',
									'type' => 'input',
									'label' => 'Pengiriman Surat',									
									'attr' => array(
										'name' => 'kirimSuratCatar',
										'id' => 'kirimSuratCatar',
										'class' => 'form-control',
										'value' => '',
									)
						),
												
						'raportAll' => array(
									'type' => 'input',
									'label' => 'Nilai Raport Semua',									
									'attr' => array(
										'id' => 'raportAll',
										'class' => 'form-control',
										'value' => '',
										'placeholder' => 'Pisahkan antar nilai dengan SPASI'
									)
						),
												
						'nilaiRaportCatar' => array(
									'column_name' => 'nilaiRaport',
									'type' => 'input',
									'label' => 'Rata-Rata Raport',									
									'attr' => array(
										'name' => 'nilaiRaportCatar',
										'id' => 'nilaiRaportCatar',
										'class' => 'form-control',
										'value' => '',
									)
						),
												
						'nilaiTKDCatar' => array(
									'column_name' => 'nilaiTKD',
									'type' => 'input',
									'label' => 'Nilai TKD',									
									'attr' => array(
										'name' => 'nilaiTKDCatar',
										'id' => 'nilaiTKDCatar',
										'class' => 'form-control',
										'value' => '',
									)
						),
												
						'nilaiPsiko' => array(
									'column_name' => 'nilaiPsiko',
									'type' => 'input',
									'label' => 'Nilai Psikotest',									
									'attr' => array(
										'name' => 'nilaiPsikoCatar',
										'id' => 'nilaiPsikoCatar',
										'class' => 'form-control',
										'value' => '',
									)
						),
						
						'catatanCatar' => array(
									'column_name' => 'catatan',
									'type' => 'input',
									'label' => 'Catatan',									
									'attr' => array(
										'name' => 'catatanCatar',
										'id' => 'catatanCatar',
										'class' => 'form-control',
										'value' => ''
									)
						),
						
						'petugasCatar' => array(
									'column_name' => 'petugas',
									'type' => 'input',
									'label' => 'Petugas Entry',									
									'attr' => array(
										'name' => 'petugasCatar',
										'id' => 'petugasCatar',
										'class' => 'form-control',
										'value' => '',
										'disabled' => 'disabled'
									)
						),
					);
		
	public function __construct(){
		parent::__construct();
		
		$this->load->model('addeditdelete_model');
		
		//updating form with value form table		
		$list_for_form = $this->addeditdelete_model->get_grouped_values('provinsi',"ptb_dataExcel",true);
		update_value_array($this->form_items,'provinsiCatar->options',$list_for_form);		
				
		$list_for_form = $this->addeditdelete_model->get_grouped_values('jenisCounter',"ptb_dataExcel",true);
		update_value_array($this->form_items,'jenisCounterCatar->options',$list_for_form);		
				
		$list_for_form = $this->addeditdelete_model->get_grouped_values('jenisCounter',"ptb_dataExcel",true);
		update_value_array($this->form_items,'jenisCounterCatar->options',$list_for_form);		
		//-------------------------------
		
		$this->addeditdelete_model->init($this->form_items);
	}
	
	public function index(){
		unset($_SESSION['class']);
		redirect(base_url().$this->router->class."/add");
		return;
	}
	
	public function generate_no_surat($id=NULL){
		if($id == NULL){
			redirect(site_url('listcatar'));
			return;
		}
		
		$details = $this->addeditdelete_model->get_details($id);
		
		if($details['tglSuratPanggilan']>0){
			redirect(site_url('documents/print_surat/'.$id));
			return;
		}
		
		$this->addeditdelete_model->generate_no_surat($id);
		redirect(site_url('documents/print_surat/'.$id));
		return;
	}
	
	public function add(){
		if(!empty($_POST)){
			$this->addeditdelete_model->insert_update_db($this->input->post(),'insert');			
			redirect(site_url('listcatar'));
			return;
		}
		
		$latest_id = $this->addeditdelete_model->get_latest_id();
		$this->addeditdelete_model->update_form_value('noDaftCatar',$latest_id);
		$this->addeditdelete_model->update_form_value('petugasCatar',$_SESSION['username']);
		$this->addeditdelete_model->delete_form_item('status');
		$this->addeditdelete_model->delete_form_item('tanggal_aktif');		
		
		$data['list'] = $this->addeditdelete_model->get_current_form();
		
		$data['title'] = "Tambah Calon Taruna Baru";		
		$data['subtitle'] = "Kolom bertanda (<span style='color:red'>*</span>) wajib diisi";	
		
		$data['controller'] = $this->router->class;
		$data['method'] = $this->router->method;
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
		
		$this->load->view('addeditdelete/form',$data);
		$this->load->view('addeditdelete/addeditdelete_js',$data);
		
		$this->load->view('templates/footer');
		
		return;
	}
		
	public function edit($id=NULL){
		if(!empty($_POST)){
			$this->addeditdelete_model->insert_update_db($this->input->post(),'update');			
			redirect(site_url('listcatar/main'));
			return;
		}
		
		if($id == NULL){
			redirect(site_url($this->router->class.'/add'));
			return;
		}
		
		$details = $this->addeditdelete_model->get_details($id);
		$this->addeditdelete_model->set_form_value_from_db($details);
		$this->addeditdelete_model->update_form_value('petugasCatar',$_SESSION['username']);
				
		$data['list'] = $this->addeditdelete_model->get_current_form();
		
		$data['title'] = "Edit Data Calon Taruna";		
		$data['subtitle'] = "Kolom bertanda (<span style='color:red'>*</span>) wajib diisi";	
		
		$data['controller'] = $this->router->class;
		$data['method'] = $this->router->method;
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
		
		$this->load->view('addeditdelete/form',$data);
		$this->load->view('addeditdelete/addeditdelete_js',$data);
		
		$this->load->view('templates/footer');
	}
	
	protected function unable_delete($id){				
		$details = $this->addeditdelete_model->get_details($id);
		$this->addeditdelete_model->set_form_value_from_db($details);
		
		$data['list'] = $this->addeditdelete_model->get_current_form();
		
		$delete_form = array(
							'tanggal_aktif' => $data['list']['tanggal_aktif'],
							'noDaftCatar' => $data['list']['noDaftCatar'],
							'namaCatar' => $data['list']['namaCatar'],
							'pilihan1Catar' => $data['list']['pilihan1Catar'],
						);
		update_value_array($delete_form,'noDaftCatar->attr->disabled','disabled');		
		update_value_array($delete_form,'namaCatar->attr->disabled','disabled');		
		update_value_array($delete_form,'pilihan1Catar->attr->disabled','disabled');
				
		$this->addeditdelete_model->init($delete_form);
		
		$data['list'] = $this->addeditdelete_model->get_current_form();
		$data['title'] = "Penghapusan Gagal";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
		
		$this->load->view('addeditdelete/unable_to_delete',$data);
		
		$this->load->view('templates/footer');
		return;
	}
	
	public function delete($id=NULL){
		if(!empty($_POST)){
			$noDaft = $_POST['noDaft'];			
			
			if($id != $noDaft){
				redirect($this->router->class.'/delete/'.$id);
				return;
			}
			
			$this->addeditdelete_model->delete_from_db($noDaft);
			redirect(site_url('listcatar/main'));
			return;
		}
		
		if($id == NULL){
			redirect(site_url('listcatar/main'));
			return;
		}
				
		$status = $this->addeditdelete_model->check_registration_status($id);
		if($status){
			//if status is 'Active', delete is not allowed, until status changed to inactive
			$this->unable_delete($id);
			return;
		}	
		
		$details = $this->addeditdelete_model->get_details($id);
		$this->addeditdelete_model->set_form_value_from_db($details);
		
		$data['list'] = $this->addeditdelete_model->get_current_form();
		
		$delete_form = array(
							'noDaftCatar' => $data['list']['noDaftCatar'],
							'namaCatar' => $data['list']['namaCatar'],
							'pilihan1Catar' => $data['list']['pilihan1Catar'],
						);
		update_value_array($delete_form,'noDaftCatar->attr->disabled','disabled');		
		update_value_array($delete_form,'namaCatar->attr->disabled','disabled');		
		update_value_array($delete_form,'pilihan1Catar->attr->disabled','disabled');		
						
		$this->addeditdelete_model->init($delete_form);
		
		$data['list'] = $this->addeditdelete_model->get_current_form();
		$data['title'] = "Konfirmasi Penghapusan";	
		$data['noDaft'] = $this->addeditdelete_model->get_form_value('noDaftCatar');	
		//~ var_dump($delete_form);
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
		
		$this->load->view('addeditdelete/delete_confirmation',$data);
		$this->load->view('addeditdelete/addeditdelete_js',$data);
		
		$this->load->view('templates/footer');
	}
}
