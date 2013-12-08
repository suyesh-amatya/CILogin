<?php

class Site extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('table');
		$this->load->helper('form');
	}

	public function login_activity(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		$id = $this->session->userdata('id');
		if($is_logged_in){
			$this->load->model("users_model");
			$data['log_in_data'] = $this->users_model->last_five_logins($id);
			//echo '<pre>';
			//print_r($data);die();
			//$this->load->view('login_activity', $data);
			$data['main_content'] = "login_activity";
			$this->load->view('includes/template', $data);
		}
		else{
			$data['main_content'] = "login_form";
			$this->load->view('includes/template', $data);
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		$data['msg'] = "You have successfully logged out!";
		$data['main_content'] = "login_form";
		$this->load->view('includes/template', $data);
	}

}