<?php

class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('date');
		$this->load->library('form_validation');
	}
	
	public function index($error=NULL, $msg=NULL){
		$data['error'] = $error;
		$data['msg'] = $msg;
		$data['main_content'] = "login_form";
		$this->load->view('includes/template', $data);
	}
	
	public function validate_user(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if ($this->form_validation->run() === FALSE){
			$data['main_content'] = "login_form";
			$this->load->view('includes/template', $data);
		}
		else{
			$this->load->model("users_model");
			$query_result = $this->users_model->validate();
			//echo '<pre>';
			//print_r($query_result);
			if(is_array($query_result) && count($query_result)===1){
				$logged_in_time = date('Y-m-d H:i:s');
				$log = array(
						'id' => $query_result[0]['id'],
						'logged_in_time'=>$logged_in_time
					);
				
				$this->users_model->log_time($log);
				
				$data = array(
					'id' => $query_result[0]['id'],
					'name' => $query_result[0]['first_name'],
					'is_logged_in' => true
				);
				
				$this->session->set_userdata($data);
				//var_dump($this->session->all_userdata()); 
				
				redirect('site/login_activity');
				//$data['main_content'] = "login_activity";
				//$this->load->view('includes/template', $data);
				//SELECT * FROM `users` JOIN login_details ON users.id = login_details.id where users.id = 2
			}
			else{
				$error="Invalid Email/Password combination!";
				$this->index($error);
			}

		}
	}
	
	
	function signup($error=NULL){
		$data['main_content'] = 'signup_form';
		$data['error'] = $error;
		$this->load->view("includes/template", $data);
	}
	
	function signup_member(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('repassword', 'Re-Password', 'trim|required|matches[password]');
		
		if ($this->form_validation->run() === FALSE){
			$data['main_content'] = "signup_form";
			$this->load->view('includes/template', $data);
		}
		else{
			$this->load->model("users_model");
			$query_result = $this->users_model->signup();
			if(!$query_result){
				$error="Email already registered!";
				$this->signup($error);
			}
			else{
				$msg="Registered Successfully! You can log in now.";
				$this->index(NULL, $msg);
			}
		}

	
	}

}