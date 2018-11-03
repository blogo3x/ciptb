<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class documents_model extends CI_Model {		
	public function __construct(){
		$this->load->database();
	}
			
	public function get_data_surat_panggilan($noDaft=NULL){
		if($noDaft==NULL)
			return "Nothing to show";			
		
		$this->db->select('
							aa.suratPanggilan AS SURAT_PANGGILAN,
							aa.tglSuratPanggilan AS TGL_SURAT_PANGGILAN,
							aa.JK AS JK,
							IF(aa.JK="P","Sdri.","Sdr.") AS JK_SDR,
							IF(aa.JK="P","Taruni","Taruna") AS JK_TARUNA,
							aa.nama AS NAMA,
							aa.asalSekolah AS ASAL_SEKOLAH,
							aa.gelombang AS GEL_ANGKA,
							IF(aa.gelombang=3,"Ketiga",IF(aa.gelombang=2,"Kedua","Pertama")) AS GEL_HURUF_KE,
							IF(aa.gelombang=3,"Tiga",IF(aa.gelombang=2,"Dua","Satu")) AS GEL_HURUF,
							UPPER(bb.prodiPanjang) AS PROGRAM_STUDI,
							aa.idHerregSurat AS ID_HERREG,
							cc.optContent AS TOTAL,
							dd.optContent AS ANGSURAN_1,
							ee.optContent AS ANGSURAN_2,
							ff.optContent AS BATAS_BAYAR_SEMESTER,
							gg.optContent AS BATAS_KONFIRMASI_BAYAR,
							hh.optContent AS BATAS_ANGSURAN_1,
							ii.optContent AS BATAS_ANGSURAN_2,
							bb.biayaSmt AS BIAYA_SEMESTER,
							CONCAT(jj.tahunPtb,"/",jj.tahunPtb+1) AS TAHUN_AKADEMIK
						');
		$this->db->from("ptb_dataExcel AS aa");
		$this->db->join("ptb_dataprodi AS bb",'aa.pil1 = bb.prodiPendek');
		$this->db->join("ptb_optionsgelombang AS cc",'aa.gelombang = cc.optGelombang AND cc.optKeyword = "TOTAL"');
		$this->db->join("ptb_optionsgelombang AS dd",'aa.gelombang = dd.optGelombang AND dd.optKeyword = "ANGSURAN_1"');
		$this->db->join("ptb_optionsgelombang AS ee",'aa.gelombang = ee.optGelombang AND ee.optKeyword = "ANGSURAN_2"');
		$this->db->join("ptb_optionsgelombang AS ff",'aa.gelombang = ff.optGelombang AND ff.optKeyword = "BATAS_BAYAR_SEMESTER"');
		$this->db->join("ptb_optionsgelombang AS gg",'aa.gelombang = gg.optGelombang AND gg.optKeyword = "BATAS_KONFIRMASI_BAYAR"');
		$this->db->join("ptb_optionsgelombang AS hh",'aa.gelombang = hh.optGelombang AND hh.optKeyword = "BATAS_ANGSURAN_1"');
		$this->db->join("ptb_optionsgelombang AS ii",'aa.gelombang = ii.optGelombang AND ii.optKeyword = "BATAS_ANGSURAN_2"');
		$this->db->join("ptb_tahunAktif AS jj",'jj.tahunAktif = 1');
		$this->db->where('noDaft',$noDaft);
		
		$tmp = $this->db->get()->result_array();
		
		return $tmp[0];
	}
	
	public function get_data_formulir($noDaft=NULL){
		if($noDaft==NULL)
			return "Nothing to show";			
				
		$this->db->select('
							aa.noDaft AS NO_DAFT,
							IF(aa.JK="L",1,0) AS JK_L,
							IF(aa.JK="P",1,0) AS JK_P,
							aa.nama AS NAMA,
							aa.tempatLahir AS TEMPAT_LAHIR,
							aa.tglLahir AS TANGGAL_LAHIR,
							aa.agama AS AGAMA,
							aa.asalSekolah AS ASAL_SEKOLAH,
							aa.jurusanSekolah AS JURUSAN_SEKOLAH,
							aa.alamatSekolah AS ALAMAT_SEKOLAH,
							aa.alamat AS ALAMAT,
							aa.noTelp AS NO_TELP,
							aa.email AS EMAIL,
							aa.namaAyah AS NAMA_AYAH,
							aa.pekerjaanAyah AS PEKERJAAN_AYAH,
							aa.namaIbu AS NAMA_IBU,
							UPPER(aa.petugas) AS PETUGAS,
							aa.provinsi AS PROVINSI,
							(SELECT prodiPanjang FROM ptb_dataprodi WHERE prodiPendek = pil1) AS pil1, 
							(SELECT prodiPanjang FROM ptb_dataprodi WHERE prodiPendek = pil2) AS pil2, 
							(SELECT prodiPanjang FROM ptb_dataprodi WHERE prodiPendek = pil3) AS pil3, 
							aa.foto3x4 AS c1,
							aa.fotoPostcard AS c2,
							aa.SKSehat AS c3,
							aa.raport AS c4,
							aa.akteLahir AS c5,
							aa.skck AS c6,
							aa.ijazah AS c7,
						');									
		$this->db->from("ptb_dataExcel AS aa");
		$this->db->join("ptb_dataprodi AS bb",'aa.pil1 = bb.prodiPendek');
		$this->db->where('aa.noDaft',$noDaft);
		
		$tmp = $this->db->get()->result_array();
		
		return $tmp[0];
	}
}
