<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class configurations extends CI_Controller {	
	protected $num_rows;
	protected $controller;
	protected $method;
	protected $current_url;
	
	protected $form_add_tahun = array(
					'add_tahun_ptb' => array(
								'column_name' => 'tahunPtb',
								'type' => 'input',
								'label' => 'Tambah Tahun',
								'attr' => array(
									'name' => 'add_tahun_ptb',
									'id' => 'add_tahun_ptb',
									'class' => 'form-control',
									'value' => '',
								),
						)
				);
	
	public function __construct(){
		parent::__construct();
		$this->load->model('configurations_model');
		$this->load->library('blo_table');
		
		$this->controller = $this->router->class;
		$this->method = $this->router->method;
		$this->current_url = site_url($this->controller.'/'.$this->method);
	}
	
	public function tahun_aktif(){
		if(!empty($_POST)){
			if(isset($_POST['set_tahun_aktif'])){
				$tahun_aktif = $_POST['set_tahun_aktif'];
				$this->configurations_model->set_tahun_aktif($tahun_aktif);
				redirect($this->current_url);
				
				return;
			}
			
			if(isset($_POST['delete_tahun_ptb'])){
				$tahun_ptb = $_POST['delete_tahun_ptb'];
				$this->configurations_model->delete_tahun_ptb($tahun_ptb);
				redirect($this->current_url);
				
				return;
			}
			
			if(isset($_POST['add_tahun_ptb'])){
				$tahun_ptb = $_POST['add_tahun_ptb'];
				
				if(strlen($tahun_ptb)<=0){
					redirect($this->current_url);
					return;
				}
				
				$this->configurations_model->add_tahun_ptb($tahun_ptb);
				redirect($this->current_url);
				
				return;
			}
			return;
		}
		
		$data['list_tahun'] = $this->configurations_model->get_list_tahun();
		
		$this->blo_table->init($this->configurations_model->get_num_rows());
		$this->blo_table->set_heading(array(
										"NO",
										"TAHUN",
										"AKTIF?",
										"SET",
										"HAPUS",
									));
				
		$data['table'] = $this->blo_table->generate($data['list_tahun']);
		$data['pagination']=$this->blo_table->pagination_link();
		$data['total_rows']=$this->blo_table->get_total_rows();
		$data['current_rows']=$this->blo_table->get_range_rows();		
		
		$data['title'] = 'List Tahun PTB';
		
		$data['controller'] = $this->controller;
		$data['method'] = $this->method;
		
		$data['form_input'] = $this->form_add_tahun;
		
		$data['grid_width'] = 6;
					
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/content', $data);
		
		$this->load->view('configurations/tahun_aktif', $data);
		$this->load->view('templates/table', $data);
		
		$this->load->view('templates/footer');
	}
}
