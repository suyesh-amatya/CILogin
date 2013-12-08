<?php

class Users_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function validate(){
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('users');
		if($query->num_rows === 1){
			return $query->result_array();
		}
	}
	
	public function log_time($data){
		//print_r($data);
		$this->db->insert('login_details', $data);
	}
	
	public function signup(){
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('users');
		if($query->num_rows === 1){
			return false;
		}
		else{
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password'))
			);
			return $this->db->insert('users', $data);
		}
	}
	
	public function last_five_logins($id){
		//SELECT * FROM `users` JOIN login_details ON users.id = login_details.id where users.id = $id
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('login_details', 'users.id = login_details.id');
		$this->db->where('users.id', $id);
		$this->db->order_by("login_details.logged_in_time", "desc"); 
		$this->db->limit(5);
		
		$query = $this->db->get();
		return $query->result_array();
		
		//echo $str = $this->db->last_query(); die();
	
	}
}