<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel  extends CI_model {



	function __construct() {
		parent::__construct();

		$this->load->library('user_agent');

	}
/*
	function login_process() {

		$username = $this->security->xss_clean($this->input->post('username'));
		$password = $this->security->xss_clean($this->input->post('password'));
		$result = $this->mongo_db
			->where('studentregno',$username)
			->where('password',$password)
			->getOne('students');
		$data = $this->mongo_db->row_array($result);
		if($data){
			$hashkey = hash("sha256", $data["_id"].date('Y-m-d H:i:s') . rand() . "tefghfg8542djf" . rand());
			$data_session = array(
				'sid' => $data["_id"],
				'regno' => $data["studentregno"],
				'usertype' => "student",
				'std' => $data["std"],
				'inst_regno' => $data["inst_regno"],
				'institute_name' => $data["institute_name"],
				'student_name' => $data["studname"],
				'student_type' => $data["stype"],
				'session_id' => $hashkey,
				'validated' => true
			);
			$this->session->set_userdata($data_session);
		//	$this->mongo_db->upd

			$this->mongo_db->set('session_id', $hashkey)
				->set('last_login', $this->mongo_db->date())
				->where('_id',new MongoDB\BSON\ObjectId($data["_id"]))
				->update('students', array(
				'upsert' => TRUE
			));
			$this->mongo_db->insert("login_bruteforce",array("bip"=> $this->input->ip_address(),"btimestamp"=> $this->mongo_db->date(),"userid"=>$username,"status"=>0,"user_agent"=>$this->agent->browser()));
			return  1;
		}else{
			$this->mongo_db->insert("login_bruteforce",array("bip"=> $this->input->ip_address(),"btimestamp"=> $this->mongo_db->date(),"userid"=>$username,"status"=>1));
			return  0;
		}

		return  0;

	}
*/
	function examinerlogin_process() {

		$username = $this->security->xss_clean($this->input->post('username'));
		$password = $this->security->xss_clean($this->input->post('password'));
        $data = $this->db
			->where('username',$username)
			->where('password',$password)
			->where('status',1)
			->get('user')->row_array();

		if($data){

			$data_session = array(
				'userid' => $data["user_id"],
				'usergroup' =>  $data["user_group"],
				'useralias' => $data["name"],
				'validated' => true
			);
			$this->session->set_userdata($data_session);

			//$this->mongo_db->insert("login_bruteforce",array("bip"=> $this->input->ip_address(),"btimestamp"=> $this->mongo_db->date(),"userid"=>$username,"status"=>0));
			return  1;
		}else{
			//$this->mongo_db->insert("login_bruteforce",array("bip"=> $this->input->ip_address(),"btimestamp"=> $this->mongo_db->date(),"userid"=>$username,"status"=>1));
			return  0;
		}

		return  0;

	}




}
