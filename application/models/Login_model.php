<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class login_model extends CI_Model {
	protected $username;
	protected $password;
	
	public function __construct(){
		$this->load->database();
	}
	
	public function logging_in($username,$password){
		$this->username = $username;
		$this->password = sha1($username.$password."muertedeaf");
		
		$this->db->from("tb_user")
				->where('username',$this->username)
				->where('password',$this->password );
		
		$result = $this->db->count_all_results();
		$this->set_session($result);
		return $result;
	}
	
	protected function set_tahun_aktif(){
		$tahun_aktif = $this->db->select("tahunPtb")
								->from("ptb_tahunAktif")
								->where('tahunAktif = ',1)
								->get()
								->row()
								->tahunPtb;
		$_SESSION['tahun_aktif'] = $tahun_aktif;		
		$_SESSION['tahun_akademik'] = ($tahun_aktif).'/'.($tahun_aktif+1);		
	}
	
	protected function generate_sidebar($level){
		$this->db->select('
						className AS name,
						classShownName AS title,
						classSidebarIcon AS icon
						');
		$this->db->from("tb_classes");
		$this->db->join("tb_access_permitions",'permitClass = className');
		$this->db->where('permitLevel = ',$level);
		$this->db->where('classSidebarIcon IS NOT NULL');
		$this->db->order_by('classId ASC');
		
		$_SESSION['sidebar'] = $this->db->get()->result();
		return;
	}
	
	protected function set_session($is_valid=FALSE){
		if(!$is_valid)
			return;
			
		$session_items = $this->db->select('
										aa.id AS id,
										aa.username AS username,
										aa.level AS level,
										bb.role AS role'
									)
								->from("tb_user AS aa")
								->join("ptb_role AS bb",'aa.level=bb.level')
								->where('aa.username = ',$this->username)
								->get()
								->row();
									
		$this->session->set_userdata('logged_in', time());
		$this->session->set_userdata('id', $session_items->id );
		$this->session->set_userdata('username', $session_items->username );
		$this->session->set_userdata('level', $session_items->level );
		$this->session->set_userdata('role', $session_items->role );
		
		$this->set_tahun_aktif();
		$this->generate_sidebar($session_items->level);
	}
}
