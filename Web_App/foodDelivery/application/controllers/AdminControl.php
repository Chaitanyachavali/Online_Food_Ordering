<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminControl extends CI_Controller {

	public function __construct()
	{
				 parent::__construct();
				 session_start();
				 
				 date_default_timezone_set("Asia/Kolkata");
			
	}

	//Login Page
	public function index()
	{
		$this->load->view('login');
	}

	//Login Check
	public function loginForm()
	{
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$this->load->model("databaseConnect");
		$check = $this->databaseConnect->checkUserExit($username, $password);
		if($check == 1)
		{
			$datavals = $this->databaseConnect->getUserDetails($username);
			$_SESSION['username'] = $datavals->username;
			$_SESSION['name'] = $datavals->name;
			$_SESSION['contact'] = $datavals->contact;
			$_SESSION['mail'] = $datavals->mail;
			$data["row"] = $datavals;
			$this->load->view('dashboard',$data);
			//redirect("AdminControl/pagename");

		}
		else
		{
			session_unset();
			session_destroy();
			$data["wrong"] = true;
			$this->load->view('login',$data);
			//redirect(base_url());
		}
	}
}
