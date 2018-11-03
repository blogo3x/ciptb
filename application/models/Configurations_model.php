<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class configurations_model extends CI_Model {		
	public function __construct(){
		$this->load->database();
	}
	
	public function process_array($data,$start=1){
		global $status;
					
		for($i=0;$i<sizeof($data);$i++){		
			$is_tahun_aktif = $data[$i]['AKTIF'];		   								   
			
			$data[$i] = array('NO' => $start+$i) +$data[$i];
			
			$data[$i]['AKTIF'] = $status[$is_tahun_aktif];	
			if(!$is_tahun_aktif){
				$data[$i]['ACTION_SET'] = '<form method=POST action="'.site_url($this->router->class.'/'.$this->router->method).'">
										<input type=hidden name=set_tahun_aktif value="'.$data[$i]['TAHUN'].'">
										<input type=submit class="btn btn-sm btn-success" value="SET TAHUN AKTIF">
									   </form>';
			}
			else
				$data[$i]['ACTION_SET'] = '';
				
			$data[$i]['ACTION_DELETE'] = '<form method=POST action="'.site_url($this->router->class.'/'.$this->router->method).'">
									<input type=hidden name=delete_tahun_ptb value="'.$data[$i]['TAHUN'].'">
									<input type=submit class="btn btn-sm btn-danger '.(($is_tahun_aktif)?('disabled'):('')).'" value="HAPUS">
								   </form>';
		}
		
		return $data;
	}
	
	public function get_list_tahun(){
		$this->db->select('
							tahunPtb AS TAHUN,
							tahunAktif AS AKTIF
						');
		$this->db->from("ptb_tahunAktif");			
		$this->db->order_by('TAHUN DESC');			
		$this->num_rows = $this->db->count_all_results('',FALSE);				
		$tmp = $this->db->get()->result_array();
		
		return $this->process_array($tmp);
	}		
	
	public function get_num_rows(){
		return $this->num_rows;
	}
	
	public function set_tahun_aktif($tahun_aktif){
		$sql = 'UPDATE `ptb_tahunAktif` SET tahunAktif = CASE WHEN tahunPtb = ? THEN 1 ELSE 0 END';
		$this->db->query($sql,$tahun_aktif);
		
		$_SESSION['tahun_aktif'] = $tahun_aktif;
		//~ echo $this->db->last_query();
	}
	
	public function add_tahun_ptb($tahun_ptb){
		$this->db->set('tahunPtb',$tahun_ptb);
		$this->db->insert("ptb_tahunAktif");
		//~ echo $this->db->get_compiled_insert("ptb_tahunAktif");
	}
	
	public function delete_tahun_ptb($tahun_ptb){
		$this->db->where('tahunPtb',$tahun_ptb);
		$this->db->where('tahunAktif !=',1);
		$this->db->delete("ptb_tahunAktif");
		//~ echo $this->db->get_compiled_insert("ptb_tahunAktif");
	}
}
