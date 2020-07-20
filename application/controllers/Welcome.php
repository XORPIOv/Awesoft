<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('UserModel');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function dashboard()
	{
		$uid = $this->session->userdata('uid');
		//1- make a call to a method in the model
		//2- after the call is sucessful, load the data to the view below
		$result = $this->UserModel->getUserName($uid);
		$all_users = $this->UserModel->getUsers();
		$data = array();
		$data['username'] = $result;
		$data['users'] = $all_users;
		$this->load->view('userdashboard/dashboard', $data);
	}

	public function adduser()
	{
		$this->load->view('userdashboard/adduser');
	}
	public function doadduser()
	{
		$formusername = $this->input->post("username");
		$formemail = $this->input->post("email");
		$formpassword = $this->input->post("password");
		$foroccupation = $this->input->post("occupation");
		$forbirth = $this->input->post("birth");
		$this->UserModel->addnewuser($formusername, $formemail, $formpassword,$foroccupation, $forbirth );
		redirect('welcome/dashboardq');
	}

	public function edituser()
	{
		$userid = $this->input->get("id");
		$userinfo = $this->UserModel->getUserByID($userid);
		$data = array();
		$data['userinfo'] = array_pop($userinfo);
		$this->load->view("userdashboard/edituser", $data);
	}
	public function doedituser()
	{
		$formusername = $this->input->post("username");
		$formemail = $this->input->post("email");
		$foroccupation = $this->input->post("occupation");
		$forbirth = $this->input->post("birth");
		$formpassword = $this->input->post("password");
		$uid = $this->input->post("uid");
		$this->UserModel->edituser($uid, $formusername, $formemail, $formpassword, $foroccupation,$forbirth  );
		redirect('welcome/dashboard');
	}

	public function showAllUsers()
	{
		$all_users = $this->UserModel->getUsers();
		$data = array();
		$data['users'] = $all_users;
		$this->load->view('welcome_message', $data);
	}

	public function dologin()
	{
		$formusername = $this->input->post("username");
		$formpassword = $this->input->post("password");
		$result = $this->UserModel->verfiylogin($formusername, $formpassword);
		if ($result != 0) {
			$this->session->set_userdata("isuserloggedin", "true");
			$this->session->set_userdata("uid", $result);
			redirect('welcome/dashboardq');
		} else {
			echo "username and password are incorrect";
		}
	}
	public function dashboardq()
	{
		$uid = $this->session->userdata('uid');
		//1- make a call to a method in the model
		//2- after the call is sucessful, load the data to the view below
		$result = $this->UserModel->getUserName($uid);
		$all_questions = $this->UserModel->getqu();
		$data = array();
		$data['username'] = $result;
		$data['questions'] = $all_questions;
		$this->load->view('userdashboard/qdashboard', $data);
	}

	public function showAllQu()
	{
		$all_questions = $this->UserModel->getqu();
		$data = array();
		$data['questions'] = $all_questions;
		$this->load->view('welcome_messageq', $data);
	}
	public function addqu()
	{
		
		$this->load->view('userdashboard/addqu');
	}
	public function doaddqu()
	{
		//Code to get the ID 115
		$uid = $this->session->userdata('uid');
		$formquestion = $this->input->post("question");
		
		 $this->UserModel->addnewqu($formquestion, $uid);
		
		$this->session->set_userdata("isuserloggedin", "true");
		$this->session->set_userdata("uid", $formquestion);
		redirect('welcome/dashboardq');
	 
	}

	public function editqu()
	{ //get the quastion id
		$qid = $this->input->get("qid");
		// get all information with quastion id
		$quinfo = $this->UserModel->getQuByID($qid);
		// get all answers assoced with quastion id
		$answers = $this->UserModel->getanswerbyqid($qid);
		// create an array variable name data
		$data = array();
		//put all answers to a spefic quastion
		$data['quinfo'] = array_pop($quinfo);
		//put all the answers
		$data['answers'] = ($answers);
		//load all the data in the view editqu
		$this->load->view("userdashboard/editqu", $data);
	}
	public function doeditqu()
	{
		$uid = $this->session->userdata('uid');
		$formanswer = $this->input->post("answer");
		$qid = $this->input->post("qid");
		
		$this->UserModel->doaddanswer( $qid,$formanswer, $uid,);
        
			$this->session->set_userdata("isuserloggedin", "true");
			$this->session->set_userdata("qid");
		redirect('welcome/dashboardq');

		
	
}
}
