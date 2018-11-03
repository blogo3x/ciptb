<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class listcatar_model extends CI_Model {
		
		protected $num_rows;
		protected $table;
		
        public function __construct(){
			$this->load->database();
			$this->table = "ptb_dataExcel";
        }
        
        protected function process_array($data,$start=1){
			global $status;
						
			for($i=0;$i<sizeof($data);$i++){
				$data[$i] = array('DETAILS' => '<button type="button" class="btn btn-xs btn-info show_details" data-toggle="modal" data-target=".modal-target" data-nama="'.$data[$i]['NAMA'].'" data-nodaft="'.$data[$i]['NO_DAFT'].'">Details</button>') +$data[$i];
				$data[$i] = array('NO' => $start+$i) +$data[$i];
				
				$data[$i]['STATUS_HERREG'] = '<div style="text-align:center;">'.$status[$data[$i]['STATUS_HERREG']].'</div>';
			}			
			return $data;
		}
        
        protected function get_search_data($index="search"){
			if(isset($_SESSION['class'][$this->router->class][$index]))
				return $_SESSION['class'][$this->router->class][$index];
			else if(isset($_SESSION['class'][$this->router->class]))
				return $_SESSION['class'][$this->router->class];
			else
				return FALSE;
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
			//~ echo "<pre>";var_dump($result);echo"</pre>";
			return $result;
		}
        
        public function get_listcatar($start=0,$limit=0,$is_search = FALSE){
			$search_data = $this->get_search_data();
						
			$limit = ($limit>0)?:($this->config->item('per_page'));
			
			$this->db->select('
									UPPER(noDaft) AS NO_DAFT,
									IF(tglAktif>0,1,0) AS STATUS_HERREG,
									UPPER(gelombang) AS GELOMBANG,
									UPPER(nama) AS NAMA,
									UPPER(pil1) AS PIL1,
									UPPER(JK) AS JK,
									UPPER(agama) AS AGAMA,
									UPPER(alamat) AS ALAMAT,
									UPPER(provinsi) AS PROVINSI,
									UPPER(asalSekolah) AS ASAL_SEKOLAH,
									UPPER(noTelp) AS NO_TELP,
									UPPER(CONCAT(jenisCounter," - ",counter)) AS COUNTER,
									catatan AS CATATAN'
								);
			$this->db->from($this->table);
			
			if($search_data != FALSE){
				foreach($search_data as $key=>$val){
					if($val != ''){
						if($val=='-')							
							$this->db->where($key,'');
						else
							$this->db->like($key,$val);
					}
				}
			}
			else{
				$this->db->where('tahun=',$_SESSION['tahun_aktif']);
			}
			
			$tmp['count'] = $this->db->count_all_results('',FALSE);
			$tmp['data']  = $this->db->limit($limit, $start)->order_by('NO_DAFT DESC')->get();
			
			$this->num_rows = $tmp['count'];
			return $this->process_array($tmp['data']->result_array(),($start+1));
		}
		
		public function get_num_rows(){
			return $this->num_rows;
		}
		
		public function get_details($noDaft=NULL){
			if($noDaft==NULL)
				return "Nothing to show";			
			
			$this->db->select('*');
			$this->db->from("ptb_dataExcel");
			$this->db->where('noDaft',$noDaft);
			
			$tmp = $this->db->get()->result_array();
			
			return $tmp[0];
		}
}
