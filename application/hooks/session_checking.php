<?php
class session_checking{
	public function session_checking_redirect()
	{
		// load the instance
		$this->CI =& get_instance();
		
		if (!isset($this->CI->session)){
			$this->CI->load->library('session');
		}
		$controller = $this->CI->router->class;
		
		if(!$this->CI->session->userdata('logged_in') && $controller!='login')
			redirect(site_url('login'));
		return;
	}
}
