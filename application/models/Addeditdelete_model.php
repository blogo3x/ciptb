<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class addeditdelete_model extends CI_Model {
		protected $tahun_aktif;
		protected $form;
		protected $form_data;

		public function __construct(){
			$this->load->database();
		}
		
		public function init($array){
			$this->form = $array;
			$this->tahun_aktif = $_SESSION['tahun_aktif'];
		}
				
        public function get_grouped_values($column_name, $table, $for_search_form = TRUE){
			/*
			 * this function is used to get the options for html select input
			 * */			
			$this->db->select($column_name);
			$this->db->from($table);
			$this->db->group_by($column_name);
			
			$tmp = $this->db->get()->result_array();
			$result = [];
			$empty_row_exist = 0;
			foreach($tmp as $val){
				$result[$val[$column_name]] = ($val[$column_name]=='')?("[KOSONG]"):($val[$column_name]);
				
				if($val[$column_name]=='')
					$empty_row_exist = 1;
			}
			
			if(!$empty_row_exist && $for_search_form)
				$result = array('' => "[KOSONG]") + $result;
				
			return $result;
		}		
		
		public function update_form_value($index,$value){
			switch($this->form[$index]['type']){
				case 'input':
					update_value_array($this->form,$index.'->attr->value',$value);
					break;
				case 'select':
					update_value_array($this->form,$index.'->selected',$value);
					break;
				case 'label':
					update_value_array($this->form,$index.'->text',$value);
					break;
				default: break;
			}
		}
		
		public function delete_form_item($index){
			unset_array_index($this->form,$index);
		}
		
		public function get_latest_id(){
		//~ $sql="SELECT id,noDaft FROM `ptb_dataExcel` WHERE noDaft LIKE '".$tahunDaft."%' ORDER BY `noDaft` DESC LIMIT 1";
			$latest_id = $this->db->select('noDaft')
								->from("ptb_dataExcel")
								->where('tahun =',$this->tahun_aktif)
								->order_by('noDaft DESC')
								->limit(1)
								->get()
								->row()
								->noDaft;
									
			$latest_id = explode('-',$latest_id);
			$latest_id = substr($this->tahun_aktif,-2).'-'.($latest_id[1]+1);
			
			return $latest_id;
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

		public function generate_no_surat($noDaft){
			$noSurat = explode('-',$noDaft);
			$noSurat = $noSurat[1];
			//~ echo $idHer." ";
			
			$month = date("m",time());
			$year = date("Y",time());
			$surat_panggilan = str_pad((int)$noSurat, 4, '0', STR_PAD_LEFT)."/PTB-STTKD/".toRoman($month)."/".$year;
			$tgl_surat_panggilan = time();
			
			$this->db->set('suratPanggilan',$surat_panggilan);
			$this->db->set('tglSuratPanggilan',$tgl_surat_panggilan);
			$this->db->set('idHerregSurat',$noDaft);
			$this->db->where('noDaft =',$noDaft);
			$this->db->update("ptb_dataExcel");
			
			return true;
		}

		public function get_form_value($index){
			switch($this->form[$index]['type']){
				case 'input':
					return get_value_array($this->form,$index.'->attr->value');
					break;
				case 'select':
					return get_value_array($this->form,$index.'->selected');
					break;
				case 'label':
					return get_value_array($this->form,$index.'->text');
					break;
				default: 
					break;
			}
			
			return false;
		}		

		protected function get_index_from_column_name($index){
			foreach($this->form as $key=>$val){
				if(isset($val['column_name']) && $val['column_name'] == $index)
					return $key;
			}
			
			return false;
		}

		public function set_form_value_from_db($form_items){
			global $status;
			
			foreach($form_items as $key=>$val){
				$index_name = $this->get_index_from_column_name($key);
				
				if($index_name !== FALSE){
					//~ echo $key." => ".$index_name." = ".$val."<br>";
					$this->update_form_value($index_name,$val);
				}
			}
			
			//format shown value into readable forms
			$this->update_form_value('status',$status[$this->get_form_value('status')]); 
			$this->update_form_value('tanggal_aktif',convert_date($this->get_form_value('tanggal_aktif'),true)); 
			$this->update_form_value('tanggalLahirCatar',date("d-m-Y",$this->get_form_value('tanggalLahirCatar'))); 
			$this->update_form_value('tglSuratPanggilanCatar', ($this->get_form_value('tglSuratPanggilanCatar')>0)?( date("d-m-Y",$this->get_form_value('tglSuratPanggilanCatar')) ):('')); 
		}

		public function check_registration_status($noDaft){
			$this->db->select('
								isActive AS status_0,
								IF(tglAktif>0,1,0) AS status_1
							');
			$this->db->where('noDaft',$noDaft);
			$result = $this->db->get("ptb_dataExcel")->result_array();
			$result = $result[0];
			
			return ($result['status_0'] | $result['status_1']);
		}

		public function delete_from_db($id=NULL){
			if($id == NULL)
				return;
				
			$this->db->where('noDaft', $id);
			$this->db->delete("ptb_dataExcel");
		}

		public function insert_update_db($data,$action){
			$action = strtolower($action);
					
			$this->db->set('timestamp',time());
			$this->db->set('tahun',$_SESSION['tahun_aktif']);
			$this->db->set('petugas',$_SESSION['username']);
			
			foreach($this->form as $key=>$val){
				if(isset($data[$key])){
					if(strpos($val['attr']['class'],'datepicker') !== FALSE)
						$this->db->set($val['column_name'],strtotime($data[$key]));
					else
						$this->db->set($val['column_name'],$data[$key]);
				}
			}
			
			switch($action){
				case 'insert':			
					$noDaft = $this->get_latest_id();
					$this->db->set('noDaft',$noDaft);
					$this->db->insert("ptb_dataExcel");
					break;
					
				case 'update':
					$this->db->where('noDaft',$data['noDaftCatar']);
					$this->db->update("ptb_dataExcel");
					break;
			}	
			//~ echo $this->db->get_compiled_insert("ptb_dataExcel");			
			//~ echo "<pre>";
			//~ var_dump($data);
			//~ echo "</pre>";
		}

		public function get_current_form(){
			return $this->form;
		}
}
