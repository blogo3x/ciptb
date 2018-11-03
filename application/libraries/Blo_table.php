<?php defined('BASEPATH') OR exit('No direct script access allowed');

class blo_table {
	protected $CI;
	protected $db;
	protected $paging;

	public function __construct()
	{
			$this->CI =& get_instance();
	}

	public function init($total_rows,$type="hover")
	{
		$this->CI->load->helper('url');
		$this->CI->load->library('table');
		$this->CI->load->library("pagination");
				
		$this->paging['base_url'] = base_url().$this->CI->uri->segment(1)."/".$this->CI->uri->segment(2);
		$this->paging['total_rows'] = $total_rows;
		$this->paging['per_page'] = $this->CI->config->item('per_page');
		$this->paging['full_tag_open'] = '<ul class="pagination pagination-md no-margin pull-right">';
		$this->paging['full_tag_close'] = '</ul>';
		$this->paging['num_tag_open'] = '<li>';
		$this->paging['num_tag_close'] = '</li>';
		$this->paging['cur_tag_open'] = '<li class="active"><a href=#>';
		$this->paging['cur_tag_close'] = '</a></li>';
		$this->paging['first_tag_open'] = '<li>';
		$this->paging['first_tag_close'] = '</li>';
		$this->paging['last_tag_open'] = '<li>';
		$this->paging['last_tag_close'] = '</li>';
		$this->paging['prev_tag_open'] = '<li>';
		$this->paging['prev_tag_close'] = '</li>';
		$this->paging['next_tag_open'] = '<li>';
		$this->paging['next_tag_close'] = '</li>';
		
		$this->CI->pagination->initialize($this->paging);
				
		$template = array(
				//~ 'table_open' => '<table class="table table-'.$type.'">'
				'table_open' => '<table class="table table-condensed table-bordered table-striped table-hover">'
		);
		$this->CI->table->set_template($template);
	}
	
	public function set_heading($header){
		$this->CI->table->set_heading($header);
	}
	
	public function pagination_link(){
		return $this->CI->pagination->create_links();
	}
	
	public function generate($data){
		return "<div class='table-responsive'>".$this->CI->table->generate($data)."</div>";
	}
	
	public function get_total_rows(){
		return $this->paging['total_rows'];
	}
	
	public function get_range_rows($start=0,$limit=0,$separator="-"){
		$limit = ($limit)?:($this->paging['per_page']);
		$toIdx = ($start+$limit>$this->paging['total_rows'])?($this->paging['total_rows']):($start+$limit);
		$fromIdx = ($start<$toIdx)?($start+1):($start);
		
		return $fromIdx." ".$separator." ".$toIdx;
	}
	
	public function getb(){
		return $this->paging['base_url'];
	}
	
}
