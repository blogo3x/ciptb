<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class keuangan_model extends CI_Model {		
	protected $num_rows;
	protected $keuangan_items;
	
	public function __construct(){
		$this->load->database();
	}

	public function init($items){
		$this->keuangan_items = $items;
	}

	protected function get_search_data($index="search"){
		if(isset($_SESSION['class'][$this->router->class][$index]))
			return $_SESSION['class'][$this->router->class][$index];
		else if(isset($_SESSION['class'][$this->router->class]))
			return $_SESSION['class'][$this->router->class];
		else
			return FALSE;
	}
	
	public function get_listcatar($start=0,$limit=0,$is_search = FALSE){
		$search_data = $this->get_search_data();
					
		$limit = ($limit>0)?:($this->config->item('per_page'));
		
		$this->db->select('
							UPPER(aa.noDaft) AS NO_DAFT,
							UPPER(aa.nama) AS NAMA,
							aa.tglAktif AS TGL_AKTIF,
							UPPER(aa.gelombang) AS GELOMBANG,
							UPPER(aa.pil1) AS PIL1,
							UPPER(aa.JK) AS JK,
							bb.jumlahBayarMasuk AS UANG_MASUK,
							bb.jumlahBayarSPP AS UANG_SPP,
							bb.jumlahBayarAsrama AS UANG_ASRAMA
						');
		$this->db->from("ptb_dataExcel AS aa");
		$this->db->join("ptb_keuangan AS bb",'aa.noDaft = bb.noDaft','LEFT');
		
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
	
	protected function process_array($data,$start=1){
		global $status;
		$status_class = array('bg-red', 'bg-green');
					
		for($i=0;$i<sizeof($data);$i++){
			$data[$i] = array('DETAILS' => '<a href="'.site_url($this->router->class.'/registration/'.$data[$i]['NO_DAFT']).'" class="btn btn-block btn-xs '.$status_class[($data[$i]['TGL_AKTIF']>0)?(1):(0)].' show_details">UBAH</a>') +$data[$i];
			$data[$i] = array('NO' => $start+$i) +$data[$i];
			
			$data[$i]['NAMA'] = $status[($data[$i]['TGL_AKTIF']>0)?(1):(0)].' '.$data[$i]['NAMA'];
			$data[$i]['TGL_AKTIF'] = convert_date($data[$i]['TGL_AKTIF'],true);
			$data[$i]['UANG_MASUK'] = 'Rp '.number_format($data[$i]['UANG_MASUK'],0,',','.').',-';
			$data[$i]['UANG_SPP'] = 'Rp '.number_format($data[$i]['UANG_SPP'],0,',','.').',-';
			$data[$i]['UANG_ASRAMA'] = 'Rp '.number_format($data[$i]['UANG_ASRAMA'],0,',','.').',-';
		}			
		return $data;
	}
	
	public function get_num_rows(){
		return $this->num_rows;
	}
	
	public function get_details($noDaft=NULL){
		if($noDaft==NULL)
			return "Nothing to show";		
		
		$this->db->select('
							aa.noDaft AS noDaft,
							aa.nama AS nama,
							aa.gelombang AS gelombang, 
							aa.pil1 AS pil1, 
							aa.isActive AS status,
							aa.tglAktif AS tglAktif,
							bb.tglBayarMasuk AS tglBayarMasuk,
							bb.jumlahBayarMasuk AS jumlahBayarMasuk,
							bb.catatanMasuk AS catatanMasuk,
							bb.tglBayarSPP AS tglBayarSPP,
							bb.jumlahBayarSPP AS jumlahBayarSPP,
							bb.catatanSPP AS catatanSPP,
							bb.tglBayarAsrama AS tglBayarAsrama,
							bb.jumlahBayarAsrama AS jumlahBayarAsrama,
							bb.catatanAsrama AS catatanAsrama
						');
		$this->db->from("ptb_dataExcel AS aa");
		$this->db->join("ptb_keuangan AS bb",'aa.noDaft = bb.noDaft','LEFT');
		$this->db->where('aa.noDaft',$noDaft);
		
		$tmp = $this->db->get()->result_array();
		
		return $tmp[0];
	}
	
	public function get_current_form(){
		return $this->keuangan_items;
	}
	
	protected function get_index_from_column_name($index){
		foreach($this->keuangan_items as $key=>$val){
			if(isset($val['column_name']) && $val['column_name'] == $index)
				return $key;
		}
		
		return false;
	}

	public function update_form_value($index,$value){
		switch($this->keuangan_items[$index]['type']){
			case 'input':
				update_value_array($this->keuangan_items,$index.'->attr->value',$value);
				break;
			case 'select':
				update_value_array($this->keuangan_items,$index.'->selected',$value);
				break;
			case 'label':
				update_value_array($this->keuangan_items,$index.'->text',$value);
				break;
			default: break;
		}
	}

		public function get_form_value($index){
			switch($this->keuangan_items[$index]['type']){
				case 'input':
					return get_value_array($this->keuangan_items,$index.'->attr->value');
					break;
				case 'select':
					return get_value_array($this->keuangan_items,$index.'->selected');
					break;
				case 'label':
					return get_value_array($this->keuangan_items,$index.'->text');
					break;
				default: 
					break;
			}
			
			return false;
		}		
	
	public function set_form_value_from_db($form_items,$is_for_output = FALSE){
		global $status;
		
		foreach($form_items as $key=>$val){
			$index_name = $this->get_index_from_column_name($key);
			
			if($index_name !== FALSE){
				//~ echo $key." => ".$index_name." = ".$val."<br>";
				$this->update_form_value($index_name,$val);
			}
		}
		
		//format shown value into readable forms
		if($is_for_output){
			$tglAktifDate = $this->get_form_value('tanggal_aktif');
			
			$this->update_form_value('status',$status[$this->get_form_value('status')]);
			$this->update_form_value('tanggal_aktif',convert_date($tglAktifDate,true));
			
			$this->update_form_value('tglAktifKeuangan',($tglAktifDate>0)?(date("d-m-Y",$tglAktifDate)):(date("d-m-Y",time())));			
			$this->update_form_value('tglBayarMasukKeuangan',($this->get_form_value('tglBayarMasukKeuangan')>0)?(date("d-m-Y",$this->get_form_value('tglBayarMasukKeuangan'))):(''));
			$this->update_form_value('tglBayarSPPKeuangan',($this->get_form_value('tglBayarSPPKeuangan')>0)?(date("d-m-Y",$this->get_form_value('tglBayarSPPKeuangan'))):(''));
			$this->update_form_value('tglBayarAsramaKeuangan',($this->get_form_value('tglBayarSPPKeuangan')>0)?(date("d-m-Y",$this->get_form_value('tglBayarAsramaKeuangan'))):(''));
		}
	}
	
	public function is_already_in($noDaft){
		$this->db->from("ptb_keuangan");
		$this->db->where('ptb_keuangan.noDaft = ',$noDaft);
		
		return $this->db->count_all_results();		
	}
	
	public function delete($noDaft){
		$this->db->where('ptb_keuangan.noDaft = ',$noDaft);
		$this->db->delete("ptb_keuangan");
		
		$this->db->set('isActive','0');
		$this->db->set('tglAktif','0');
		$this->db->where('noDaft = ',$noDaft);
		$this->db->update("ptb_dataExcel");
		
		return;		
	}
		
	public function insert_update_db($noDaft,$data,$action){
		//column tglAktif doesnt exist in tb ptb_keuangan, only in ptb_dataExcel ### who the fuck designed this db? I did (T.T)
		$action = strtolower($action);
						
		foreach($this->keuangan_items as $key=>$val){
			if(isset($data[$key]) && $val['column_name']!='tglAktif'){
				if(strpos($val['attr']['class'],'datepicker') !== FALSE){
					//convert date into unix timestamp, cos I love it
					$this->db->set($val['column_name'],strtotime($data[$key]));
				}
				else if(strpos($val['attr']['class'],'currency') !== FALSE){
					//remove all non-numerics shit, so it can be inserted into db cleanly
					$this->db->set($val['column_name'],preg_replace('/\D/', '',$data[$key]));
				}
				else
					$this->db->set($val['column_name'],$data[$key]);
			}
		}
		
		switch($action){
			case 'insert':			
				$this->db->set('noDaft',$noDaft);
				//~ echo $this->db->get_compiled_insert("ptb_keuangan");	
				$this->db->insert("ptb_keuangan");
				break;
				
			case 'update':
				$this->db->where('noDaft',$noDaft);
				//~ echo $this->db->get_compiled_update("ptb_keuangan");	
				$this->db->update("ptb_keuangan");
				break;
		}			
				
		$this->db->set('tglAktif',strtotime($data['tglAktifKeuangan']));
		$this->db->set('isActive','1');
		$this->db->where('noDaft',$noDaft);
		$this->db->update("ptb_dataExcel");
		//~ echo $this->db->get_compiled_update("ptb_dataExcel");
	}
}
