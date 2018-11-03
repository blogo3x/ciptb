<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class reports_model extends CI_Model {
		
	public function __construct(){
		$this->load->database();
	}
	
	public function get_grouped_values($column_name, $table=NULL, $for_search_form = TRUE){
		/*
		 * this function is used to get the options for html select input
		 * */
		$table = ($table==NULL)?($this->table):($table);
		
		$this->db->select($column_name);
		$this->db->from($table);
		$this->db->group_by($column_name);
		
		$tmp = $this->db->get()->result_array();
		$result = [];
		$empty_row_exist = 0;
		foreach($tmp as $val){
			$result[$val[$column_name]] = ($val[$column_name]=='')?("SEMUA"):($val[$column_name]);
			
			if($val[$column_name]=='')
				$empty_row_exist = 1;
		}
		
		if(!$empty_row_exist && $for_search_form)
			$result = array('' => "SEMUA") + $result;
			
		return $result;
	}
	
	public function get_total_herregistrasi($tahun){
		global $bulan;
		
		$this->db->select('
						COUNT(*) AS JUMLAH
						');
		$this->db->from("ptb_dataExcel");
		$this->db->where('tahun=',$tahun);
		$this->db->where('isActive=',1);
		
		$result = $this->db->get()->result_array();
					
		return $result[0]['JUMLAH'];				
	}
	
	public function get_rekap_per_bulan($tahun){
		//grouped by the time when admin activated paid catar
		global $bulan;
		
		$this->db->select('
						MONTH(FROM_UNIXTIME(tglAktif)) AS BULAN,
						YEAR(FROM_UNIXTIME(tglAktif)) AS TAHUN,
						COUNT(*) AS JUMLAH
						');
		$this->db->from("ptb_dataExcel");
		$this->db->where('tahun=',$tahun);
		$this->db->where('isActive=',1);
		$this->db->group_by('BULAN');
		$this->db->group_by('TAHUN');
		$this->db->order_by('BULAN ASC');
		$this->db->order_by('TAHUN ASC');
		
		$details = $this->db->get()->result_array();
			
		foreach($details as $key=>$val){
			$result['categories'][$key] = $bulan[$val['BULAN']];
		}
		
		foreach($details as $key=>$val){
			$result['series'][$key] = $val['JUMLAH'];
		}	
		
		return $result;				
	}
	
	public function get_rekap_bayar_per_bulan($tahun){
		//grouped by the time when catar paid the fee
		global $bulan;
		
		$this->db->select('
						MONTH(FROM_UNIXTIME(bb.tglBayarMasuk)) AS BULAN,
						YEAR(FROM_UNIXTIME(bb.tglBayarMasuk)) AS TAHUN,
						COUNT(*) AS JUMLAH
						');
		$this->db->from("ptb_dataExcel AS aa");
		$this->db->join("ptb_keuangan AS bb",'aa.noDaft=bb.noDaft','left');
		$this->db->where('aa.tahun=',$tahun);
		$this->db->where('aa.isActive=',1);
		$this->db->group_by('BULAN');
		$this->db->group_by('TAHUN');
		$this->db->order_by('BULAN ASC');
		$this->db->order_by('TAHUN ASC');
		
		$details = $this->db->get()->result_array();
			
		foreach($details as $key=>$val){
			$result['categories'][$key] = $bulan[$val['BULAN']];
		}
		
		foreach($details as $key=>$val){
			$result['series'][$key] = $val['JUMLAH'];
		}	
		
		return $result;				
	}
	
	public function get_rekap_per_gelombang($tahun){
		$this->db->select('
						gelombang AS GELOMBANG,
						COUNT(*) AS JUMLAH
						');
		$this->db->from("ptb_dataExcel");
		$this->db->where('tahun=',$tahun);
		$this->db->where('isActive=',1);
		$this->db->group_by('GELOMBANG');
		$this->db->order_by('GELOMBANG');
		
		$details = $this->db->get()->result_array();
			
		foreach($details as $key=>$val){
			$result['categories'][$key] = 'Gelombang '.$val['GELOMBANG'];
		}
		
		foreach($details as $key=>$val){
			$result['series'][$key] = $val['JUMLAH'];
		}	
		
		return $result;				
	}
	
	public function get_rekap_per_JK($tahun){
		global $JK;
		
		$this->db->select('
						JK AS JK,
						COUNT(*) AS JUMLAH
						');
		$this->db->from("ptb_dataExcel");
		$this->db->where('tahun=',$tahun);
		$this->db->where('isActive=',1);
		$this->db->group_by('JK');
		$this->db->order_by('JK');
		
		$details = $this->db->get()->result_array();
			
		foreach($details as $key=>$val){
			$result['categories'][$key] = $JK[$val['JK']];
		}
		
		foreach($details as $key=>$val){
			$result['series'][$key] = $val['JUMLAH'];
		}	
		
		return $result;				
	}
	
	public function get_rekap_per_prodi($tahun){
		$this->db->select('
							pil1 AS PRODI,
							JK AS JK,
							COUNT(*)AS JUMLAH
						');
		$this->db->from("ptb_dataExcel");
		$this->db->where('tahun=',$tahun);
		$this->db->where('isActive=',1);
		$this->db->group_by('PRODI');
		$this->db->group_by('JK');
		$this->db->order_by('PRODI ASC');
		$this->db->order_by('JK ASC');
		$details = $this->db->get()->result_array();
			
		foreach($details as $key=>$val){
			$filtered_result[$val['PRODI']][$val['JK']] = $val['JUMLAH'];
		}
			
		foreach($filtered_result as $key=>$val){
			$result['categories'][$key] = $key;
			
			$result['series']['Laki-Laki'][$key] = $val['L'];
			$result['series']['Perempuan'][$key] = $val['P'];
			$result['series']['Total'][$key] = $val['P']+$val['L'];
		}
		
		return $result;	
	}
	
}
