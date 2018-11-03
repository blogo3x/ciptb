<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class counter_model extends CI_Model {		
	protected $form;
		
	public function __construct(){
		$this->load->database();
	}
	
	public function init($array){
		$this->form = $array;
	}
		
	public function get_current_form(){
		return $this->form;
	}
		
	public function get_grouped_values($column_name, $table, $for_search_form = TRUE){
		/*
		 * this function is used to get the options for html select input
		 * */			
		$this->db->select($column_name);
		$this->db->from($table);
		$this->db->group_by($column_name);
		$this->db->order_by($column_name);
		
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
}
