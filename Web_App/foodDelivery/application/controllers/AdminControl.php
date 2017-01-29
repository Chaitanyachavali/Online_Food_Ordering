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
			//$data["row"] = $datavals;
			$corders = $this->databaseConnect->getCurrentOrders();
			foreach ($corders as &$row) {
			$row->name = $this->databaseConnect->getUserName($row->mail);
			$row->item_id = $this->databaseConnect->getItemName($row->item_id);
			}
			$data["rows"] = $corders;
			$this->load->view('header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('footer', $data);
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

	//dashboard Page
	public function dashboardPage()
	{
		$this->load->model("databaseConnect");
		$corders = $this->databaseConnect->getCurrentOrders();
		foreach ($corders as &$row) {
		$row->name = $this->databaseConnect->getUserName($row->mail);
		$row->item_id = $this->databaseConnect->getItemName($row->item_id);
		}
		$data["rows"] = $corders;
		$this->load->view('header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('footer', $data);
	}

	//Delevired Page
	public function deliveredPage()
	{
		$this->load->model("databaseConnect");
		$dorders = $this->databaseConnect->getDeliveredOrders();
		foreach ($dorders as &$row) {
		$row->name = $this->databaseConnect->getUserName($row->mail);
		$row->item_id = $this->databaseConnect->getItemName($row->item_id);
		}
		$data["rows"] = $dorders;
		$this->load->view('header', $data);
		$this->load->view('delivered', $data);
		$this->load->view('footer', $data);
	}

	// signing out the user
	public function logout()
	{
		session_unset();
		session_destroy();
		redirect(base_url());
	}


	//All orderPage
	public function allOrdersPage()
	{
		$this->load->model("databaseConnect");
		$dorders = $this->databaseConnect->getAllOrders();
		foreach ($dorders as &$row) {
		$row->name = $this->databaseConnect->getUserName($row->mail);
		$row->item_id = $this->databaseConnect->getItemName($row->item_id);
		}
		$data["rows"] = $dorders;
		$this->load->view('header', $data);
		$this->load->view('delivered', $data);
		$this->load->view('footer', $data);
	}

	//Start Preparing
	public function startPrepare($id)
	{
		$this->load->model("databaseConnect");
		$this->databaseConnect->startOrder($id);
		redirect("AdminControl/dashboardPage");

	}

	//Cancel Order
	public function cancelOrder($id)
	{
		$this->load->model("databaseConnect");
		$this->databaseConnect->cancelOrder($id);
		redirect("AdminControl/dashboardPage");

	}

	//To Delivery
	public function deliverInit($id)
	{
		$this->load->model("databaseConnect");
		$this->databaseConnect->deliverStart($id);
		redirect("AdminControl/dashboardPage");

	}

	//Delivered
	public function delivered($id)
	{
		$this->load->model("databaseConnect");
		$this->databaseConnect->delivered($id);
		redirect("AdminControl/dashboardPage");

	}

	//Add Items
	public function addItem()
	{
		$this->load->model("databaseConnect");
		$categ = $this->databaseConnect->getCateg();
		$data["rows"] = $categ;

		$this->load->view('header',$data);
		$this->load->view('addItems', $data);
		$this->load->view('footer', $data);
	}

	//add Item Form
	public function addItemForm()
	{
		$name = $this->input->post("itemname");
		$categ = $this->input->post("categ");
		$price = $this->input->post("price");
		$max_maker = $this->input->post("m_n");
		$max_user = $this->input->post("m_u");
		$min_time = $this->input->post("time");
		$desc = $this->input->post("desc");

		$this->load->model("databaseConnect");
		$this->databaseConnect->addItem($name, $categ, $price, $max_maker, $max_user, $min_time, $desc);
		redirect("AdminControl/addItem");
	}
}
