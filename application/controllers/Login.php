<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index()
	{
		$data['msg']=$this->session->flashdata('msg');
		$this->load->view('admin/login',$data);
	}


	public function process() {
		$this->load->model('usermodel');
		$result = $this->usermodel->examinerlogin_process();
		if (!$result) {
			$msg = 'Invalid username and/or password.';
			$this->session->set_flashdata('msg', $msg);
			redirect("login");

		} else {
			redirect('billing');
		}
	}

	public function logout() {
		$this->session->unset_userdata('useridS');
		$this->session->unset_userdata('validated');
		redirect('login');
	}



}
