<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class login extends CI_Controller {
	protected $redirect_to = 'listcatar';
	
	public function __construct(){
		parent::__construct();		
		$this->load->model('login_model');
	}
	
	public function index(){		
		if($this->session->userdata('logged_in')){
			redirect(site_url($this->redirect_to));
			return;
		}		
		
		if(!empty($_POST)){
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$is_valid = $this->login_model->logging_in($username,$password);
			
			if($is_valid == 1){
				redirect(site_url($this->redirect_to));
				die();
			}
			
			$data['error'] = "Username / Password Salah";
			$this->load->view('login/index',$data);
		}
		else
			$this->load->view('login/index');
	}
	
	public function sign_out(){
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('role');
		$this->session->sess_destroy();
		redirect(site_url('login'));
	}
}
