<?php defined('BASEPATH') OR exit('No direct script access allowed');

class blo_search {
	protected $CI;
	protected $search_form;

	public function __construct()
	{
			$this->CI =& get_instance();
	}
	
	public function init($search_form,$search_data){
		/*
		 * Return TRUE if search is already performed, FALSE if performing new search
		 */
		 
		$this->search_form = $search_form;
		
		if(isset($_SESSION['class'][$this->CI->router->class]["search_array"]) && empty($search_data)){
			$this->search($_SESSION['class'][$this->CI->router->class]["search_array"]);
			return TRUE;
		}
		else{
			if(!empty($search_data))
				$this->search($search_data);
			
			return FALSE;
		}
	}
	
	public function update_value(&$search_form, $path, $value=NULL){
		// got from here :
		// https://stackoverflow.com/questions/27929875/how-to-access-and-manipulate-multi-dimensional-array-by-key-names-path
		// function update_value_array() is located in blo_utilites_helper
		
		update_value_array($search_form, $path, $value);
	}
	
	protected function update_search_form($index,$value){
		switch($this->search_form[$index]['type']){
			case 'input':
				$this->update_value($this->search_form,$index.'->attr->value',$value);
				break;
			case 'select':
				$this->update_value($this->search_form,$index.'->selected',$value);
				break;
			default: break;
		}
	}
		
	public function search($search_data)
	{
		$_SESSION['class'][$this->CI->router->class]["search_array"] = $search_data;
		//~ unset($_SESSION['class'][$this->CI->router->class]["search"]);
		
		foreach($this->search_form as $key=>$val){
			if(isset($search_data[$key])){
				$_SESSION['class'][$this->CI->router->class]["search"][$val['column_name']] = $search_data[$key];
	
				$this->update_search_form($key, $search_data[$key]);
			}
		}
		
		return true;
	}
	
	public function get_current_form(){
		return $this->search_form;
	}
}
