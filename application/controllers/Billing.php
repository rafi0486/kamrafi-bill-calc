<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller {

    function __construct() {
        parent::__construct(); // needed when adding a constructor to a controller
        //	if (!$this->session->userdata('sid')) {
        //		redirect('login/login');
        //	} else {
        /* if ($this->session->userdata('usertype') != "admin") {
          if ($this->config->item('is_quiz_open') == "N" && $this->config->item('show_answer') == "N") {
          redirect("login/notstarted");
          }
          } */
        //	}
        if (!$this->session->userdata('userid')) {
            redirect("login");
        }if ($this->session->userdata('usergroup') != "developer") {
            redirect("login");
        }
        $this->load->model('billingmodel');
    }

    public function index() {
        $data['summary'] = $this->billingmodel->get_developer_dashboard();
        $data['activity_tbl'] = $this->billingmodel->get_developer_activity();

        $this->load->view('template/header');
        $this->load->view('billing/dev_dashboard', $data);
        $this->load->view('template/footer');
    }

    /* Activities */

    public function activities() {

        $this->load->view('template/header');
        $id = $this->input->post('lstCustomer');
         
         
               $status =$this->input->post('lstStatus') ;
          
        $data = array("current_status" => $status, "current_id" => $id);
        $data['tbl'] = $this->billingmodel->get_user_activities($id, $status);
        $data['work_types'] = $this->billingmodel->get_user_worktypes();
        $data['customers'] = $this->billingmodel->get_parties("c");
        $this->load->view('billing/activities', $data);
        $this->load->view('template/footer');
    }

    function activities_save() {
        $res = $this->billingmodel->activity_save();
        $this->session->set_flashdata('msg', $res);
        redirect("billing/activities");
    }

    function get_single_activity() {
        echo json_encode($this->billingmodel->activity_get());
    }

    function delete_single_activity() {
        echo json_encode($this->billingmodel->activity_delete());
    }

    function get_client_projects() {
        echo json_encode($this->billingmodel->get_client_projects());
    }

    /* Rates */

    public function rates() {

        $this->load->view('template/header');
        $data['tbl'] = $this->billingmodel->user_workrates_get();
        $this->load->view('billing/rates', $data);
        $this->load->view('template/footer');
    }

    function rate_save() {
        $res = $this->billingmodel->worktype_save();
        $this->session->set_flashdata('msg', $res);
        redirect("billing/rates");
    }

    /* Client Rates */

    public function client_rates() {

        $this->load->view('template/header');
        $data['work_types'] = $this->billingmodel->get_user_worktypes();
        $data['customers'] = $this->billingmodel->get_parties("c");
        $data['tbl'] = $this->billingmodel->user_clientrates_get();
        $this->load->view('billing/client_rates', $data);
        $this->load->view('template/footer');
    }

    function client_rate_save() {
        $res = $this->billingmodel->client_rate_save();
        $this->session->set_flashdata('msg', $res);
        redirect("billing/client_rates");
    }

    /* Invoice */

    public function invoice() {

        $this->load->view('template/header');
        $data['work_types'] = $this->billingmodel->get_user_worktypes();
        $data['customers'] = $this->billingmodel->get_parties("c");
        $data['msg'] = $this->session->flashdata('msg');
        $status = $this->input->post('lstStatus');
        if (!$status) {
            $status = 0;
        }
        switch ($status) {
            case 0:$data["tTitle"] = "Pending";
                break;
            case 1:$data["tTitle"] = "Paid";
                break;
            case -1:$data["tTitle"] = "Cancelled";
                break;
            case 2:$data["tTitle"] = "Discounted";
                break;
            default:$data["tTitle"] = "Pending";
                break;
        }
        $data['tbl'] = $this->billingmodel->get_invoices($status);

        $this->load->view('billing/invoice_list', $data);
        $this->load->view('template/footer');
    }

    public function invoice_single() {

        $this->load->view('template/header');
        $data['customers'] = $this->billingmodel->get_parties("c");
        if ($this->session->userdata('inv_id')) {
            $data['iDetails'] = $this->billingmodel->get_invoice_details($this->session->userdata('inv_id'));
        }
        $this->load->view('billing/invoice_single', $data);
        $this->load->view('template/footer');
    }

    public function invoice_details($banktype = 1) {

        if ($this->session->userdata('inv_id')) {
            $this->load->view('template/header');
            $data['data'] = $this->billingmodel->get_invoice_details($this->session->userdata('inv_id'), $banktype);
            $this->load->view('billing/invoice_details', $data);
            $this->load->view('template/footer');
        } else {
            redirect("billing/invoice");
        }
    }

    function load_invoice_single($id) {
        $data_session = array(
            'inv_id' => $id
        );
        $this->session->set_userdata($data_session);
        redirect("billing/invoice_single");
    }

    function clear_invoice() {
        $data_session = array(
            'inv_id' => NULL
        );
        $this->session->set_userdata($data_session);
        redirect("billing/invoice_single");
    }

    public function get_client_pending_activities() {

        echo json_encode($this->billingmodel->get_user_activities($this->input->post('cid'), $this->input->post('status')));
    }

    public function invoice_save($type) {
        if ($type == "master") {
            $res = $this->billingmodel->invoice_master_save();
            $data_session = array(
                'inv_id' => $res
            );
            $this->session->set_userdata($data_session);
            redirect("billing/invoice_details");
        } elseif ($type == "amount") {
            $res = $this->billingmodel->invoice_amount_save();

            redirect("billing/invoice_details");
        } elseif ($type == "status") {
            $res = $this->billingmodel->invoice_status_save();

            redirect("billing/invoice_details");
        } elseif ($type == "payment") {
            $res = $this->billingmodel->invoice_payment_save();
            if ($res == "success") {
                redirect("billing/invoice_details");
            } else {
                $this->session->set_flashdata('msg', $res);
                // redirect("billing/invoice");
            }
        }
    }

    public function get_invoice_pay_details() {
        echo json_encode($this->billingmodel->get_txn_paydetails());
    }

    /*


      public function questions()
      {

      $this->load->view('template/header');
      $sid=$this->input->post('subject');
      $data['current_sid']=$sid;
      $data['questions']=$this->adminmodel->get_questions($sid);
      $data['subjects']=$this->adminmodel->get_papers();
      $this->load->view('admin/questions',$data);
      $this->load->view('template/footer');
      }

      public function papers()
      {

      $this->load->view('template/header');
      $data['msg']=$this->session->flashdata('msg');
      $data['subjects']=$this->adminmodel->get_papers();
      $this->load->view('admin/papers',$data);
      $this->load->view('template/footer');
      }
      public function students()
      {

      $this->load->view('template/header');
      $data['students']=$this->adminmodel->get_students();
      $this->load->view('admin/students',$data);
      $this->load->view('template/footer');
      }
      public function json_generate($sid)
      {
      $this->load->model('exammodel');
      $this->exammodel->questions_json_generate($sid);
      }

      public function update_exam_status(){
      $sid=$this->input->get('id');
      $status=$this->input->get('s');
      $res=$this->adminmodel->update_exam_status($sid,$status);
      $this->session->set_flashdata('msg', $res);
      echo $res;
      redirect("admin/qadmin/papers");
      }
      public function update_exam_open_close(){
      $sid=$this->input->get('id');
      $act=$this->input->get('act');
      $res=$this->adminmodel->update_exam_active($sid,$act);
      $this->session->set_flashdata('msg', $res);
      echo $res;
      redirect("admin/qadmin/papers");
      }

      public function all_students_marks(){
      $this->load->view('template/header');
      $data['data']=null;
      $std=$this->input->post('std');
      $data['std']=$std;
      if($this->input->post('view')=="View"){
      if($std){
      $data['data']=$this->adminmodel->get_results_by_std($std);
      }
      }
      $this->load->view('admin/students_marks_std',$data);
      $this->load->view('template/footer');
      }







     */

    public function get_worktype_amount() {
        echo json_encode($this->billingmodel->get_worktype_amount());
    }

}
