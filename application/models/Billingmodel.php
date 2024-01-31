<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Billingmodel extends CI_model {

    function __construct() {
        parent::__construct();
    }

    function get_user_activities($id, $status) {
        $this->db->select('a.*,c.company,wt.work_name,GetFormattedTime(billed_hr) as billed_hr_format');
        $this->db->join('ac_parties c', 'c.party_id=a.customer_id');
        $this->db->join('work_types wt', 'wt.work_type_id=a.work_type_id');
        $this->db->where('a.added_user', $this->session->userdata('userid'));
        $this->db->where('a.is_deleted', 0);
        if ($id) {
            $this->db->where('a.customer_id=', $id);
        }
        if ($status != -999) {
            $this->db->where('a.status=', $status);
        }
        return $this->db->get('activities a')->result();
    }

    function get_user_worktypes() {
        $this->db->where('added_user', $this->session->userdata('userid'));
        return $this->db->get('work_types')->result();
    }

    function get_parties($type = "c") {
        $this->db->where('added_user', $this->session->userdata('userid'));
        $this->db->where('added_user', $this->session->userdata('userid'));
        $this->db->where('party_type', $type);
        return $this->db->get('ac_parties')->result();
    }

    function get_worktype_amount() {
        $cust = $this->input->post('customer');
        $wtype = $this->input->post('worktype');
        if ($cust && $wtype) {
            $this->db->where('work_type_id', $wtype);
            $common = $this->db->get('work_types')->row();

            $this->db->where('customer_id', $cust);
            $this->db->where('work_type_id', $wtype);
            $ac_parties = $this->db->get('client_rates')->row();
            if ($ac_parties) {
                return array("common" => $common->rate_per_hr, "customer" => $ac_parties->rate_per_hr, "status" => "customer");
            } else {
                return array("common" => $common->rate_per_hr, "customer" => $common->rate_per_hr, "status" => "common");
            }
        } else {
            return array("status" => "error");
        }
    }

    function activity_save() {
        $data['activity_date'] = $this->input->post('activity_date');
        $data['customer_id'] = $this->input->post('customer');
        $data['billed_hr'] = $this->input->post('billed_hr');
        $data['actual_hr'] = $this->input->post('actual_hr');
        $data['work_type_id'] = $this->input->post('work_type');
        $data['project'] = $this->input->post('project');
        $data['bill_amount'] = $this->input->post('bill_amount');
        $data['activity_name'] = $this->input->post('activity_name');
        $data['activity_remarks'] = $this->input->post('activity_remarks');

        $aid = $this->input->post('act_id');
        if ($aid) {
            $this->db->where('activity_id', $aid);
            $this->db->update('activities', $data);
        } else {
            $data['added_user'] = $this->session->userdata('userid');
            $this->db->insert('activities', $data);
        }
    }

    function activity_get() {
        $this->db->where('activity_id', $this->input->get('id'));
        $this->db->where('added_user', $this->session->userdata('userid'));
        return $this->db->get('activities')->row();
    }

    function activity_delete() {
        $this->db->where('activity_id', $this->input->get('id'));
        $this->db->where('added_user', $this->session->userdata('userid'));
        $this->db->set('is_deleted', 1, FALSE);
        return $this->db->update('activities');
    }

    function user_workrates_get() {
        $this->db->where('added_user', $this->session->userdata('userid'));
        return $this->db->get('work_types')->result();
    }

    function worktype_save() {
        $data['work_name'] = $this->input->post('work_name');
        $data['work_description'] = $this->input->post('work_description');
        $data['rate_per_hr'] = $this->input->post('rate_per_hr');
        $aid = $this->input->post('rid');
        if ($aid) {
            $this->db->where('work_type_id', $aid);
            $this->db->update('work_types', $data);
        } else {
            $data['added_user'] = $this->session->userdata('userid');
            $this->db->insert('work_types', $data);
        }
    }

    function get_client_projects() {
        $this->db->distinct();
        $this->db->select('project');
        $this->db->where('customer_id', $this->input->post('customer'));
        return $this->db->get('activities')->result();
    }

    function user_clientrates_get() {
        $this->db->select('cr.*,c.company,wt.work_name');
        $this->db->where('cr.added_user', $this->session->userdata('userid'));
        $this->db->join('ac_parties c', 'c.party_id=cr.customer_id');
        $this->db->join('work_types wt', 'wt.work_type_id=cr.work_type_id ');
        return $this->db->get('client_rates cr')->result();
    }

    function client_rate_save() {
        $data['customer_id'] = $this->input->post('customer_id');
        $data['work_type_id'] = $this->input->post('work_type_id');
        $data['rate_per_hr'] = $this->input->post('rate_per_hr');
        $data['start_date'] = $this->input->post('start_date');
        $data['recurring_period'] = $this->input->post('recurring_period');
        $data['rate_after_limit'] = $this->input->post('rate_after_limit');
        $data['min_hr'] = $this->input->post('min_hr');
        $data['description'] = $this->input->post('description');
        $aid = $this->input->post('aid');
        if ($aid) {
            $this->db->where('cust_rate_id ', $aid);
            $this->db->update('client_rates', $data);
        } else {
            $data['added_user'] = $this->session->userdata('userid');
            $this->db->insert('client_rates', $data);
        }
    }

    function invoice_master_save() {
        $data['invType'] = $this->input->post('invType');
        $data['txn_date'] = $this->input->post('txn_date');
        $data['book_type'] = "b";
        $data['ref_no'] = $this->input->post('ref_no');
        $data['description'] = $this->input->post('description');
        $data['debit'] = 0;
        $data['credit'] = $this->input->post('customer_id');
        $data['recurring_period'] = $this->input->post('recurring_period');
        if ($this->input->post('act[]')) {
            $data['billed_activities'] = implode(",", $this->input->post('act[]'));
        }
        $data['added_user'] = $this->session->userdata('userid');
        if ($this->input->post('txid')) {
            $this->db->where('tx_id', $this->input->post('txid'));
            $this->db->update('ac_transcations', $data);
            return $this->input->post('txid');
        } else {
            $this->db->insert('ac_transcations', $data);
            return $this->db->insert_id();
        }
    }

    function get_invoice_details($id, $bank=1) {
        $this->db->where('tx_id', $id);
        $data = $this->db->get('ac_transcations')->row_array();
        if ($data["debit"] == 0) {
            $dDetails = $this->db->where('user_id', $data["added_user"])->get('user')->row();
            $data['debit_details'] = $dDetails->address;
            $data['bank_details'] = $dDetails->bank_details;
            if ($bank == 2) {
                $data['bank_details'] = $dDetails->bank_details_2;
            }
            //_2
        } else {
            $udetail = $this->db->where('party_id', $data["debit"])->get('ac_parties')->row();
            $data['debit_details'] = "<strong>" . $udetail->company . "</strong><br/>" . $udetail->address;
        }
        if ($data["credit"] == 0) {
            $data['credit_details'] = $this->db->where('user_id', $data["added_user"])->get('user')->row()->address;
        } else {
            $udetail = $this->db->where('party_id', $data["credit"])->get('ac_parties')->row();
            $data['credit_details'] = "<strong>" . $udetail->company . "</strong><br/>" . $udetail->address;
        }
        if ($data["invType"] == "D" ) { // for detailed invoices
            if ($data["billed_activities"]) {
                $data["activity_details"] = $this->db->where_in('activity_id', explode(",", $data["billed_activities"]))->order_by('project')->get('activities')->result();
            }
        }elseif ($data["invType"] == "S") { // for summary 
            if ($data["billed_activities"]) {
                $data["activity_details"] = $this->db->select('project,sum(bill_amount) as bill_amount')->where_in('activity_id', explode(",", $data["billed_activities"]))->group_by('project')->order_by('project')->get('activities')->result();
            }
        }
        
        return $data;
    }

    function invoice_amount_save() {
        if ($this->session->userdata('inv_id')) {
            $data['sub_total'] = $this->input->post('sub_total');
            $data['discount'] = $this->input->post('discount_amount');
            $data['advance'] = $this->input->post('advance');
            $data['billed_amount'] = $this->input->post('total_amount');
            $this->db->where('tx_id', $this->session->userdata('inv_id'))->update('ac_transcations', $data);
        }
    }

//    function invoice_status_save(){
//        if($this->session->userdata('inv_id')){
//            $status=$this->input->post('btn_submit');
//            if($status=="Paid"){
//                $data['status']=$this->input->post('total_amount');
//                $this->db->where('tx_id',$this->session->userdata('inv_id'))->update('ac_transcations',$data);
//            }
//            elseif($status=="Not Paid"){
//                $data['status']=$this->input->post('total_amount');
//                $this->db->where('tx_id',$this->session->userdata('inv_id'))->update('ac_transcations',$data);
//            }
//
//        }
//    }

    function invoice_payment_save() {
        $txid = $this->input->post('txid');
        $billData = $this->db->where('tx_id', $txid)->get('ac_transcations')->row();
        $activities = $billData->billed_activities;
        if ($activities) {
            $expActs = explode(",", $activities);
            $count = count($expActs);
            $check = $this->db->where_in('activity_id', $expActs)->get('activities')->num_rows();
            if ($check == $count) {
                $this->db->set('status', 1, FALSE);
                $this->db->where_in('activity_id', $expActs)->update('activities');
            } else {
                return "Duplicate Payment for Activity";
            }
        } else {

        }
        var_dump($billData);
        if ($billData->billed_amount > 0 && $this->input->post('received_amount')) {
            $data['received_date'] = $this->input->post('received_date');
            $data['received_amount'] = $this->input->post('received_amount');
            $data['balance'] = $this->input->post('balance');
            $data['remarks'] = $this->input->post('remarks');
            $data['status'] = 1;
            $this->db->where('tx_id', $txid)->update('ac_transcations', $data);
            return "success";
        } else {
            return "Payment Not Updated";
        }
    }

    function get_invoices($status) {
        $this->db->select('a.*,b.company,date_add(now(),interval ' . $this->config->item("invoice_due_date_week") . ' week) as due_date');
        $this->db->where('a.status', $status);
        $this->db->where('a.added_user', $this->session->userdata('userid'));
        $this->db->join('ac_parties b', 'a.credit=b.party_id');
        return $this->db->get('ac_transcations a')->result();
    }

    function get_txn_paydetails() {
        $txid = $this->input->post('id');
        $this->db->select('tx_id,sub_total,discount,billed_amount,received_date,received_amount,balance,remarks,status,debit,credit');
        $this->db->where('tx_id', $txid);
        return $this->db->get('ac_transcations')->row();
    }

    function get_developer_dashboard() {
        $ret = array();

        $previousMonth = $this->db->where('`Year` = YEAR(CURDATE() - INTERVAL 1 MONTH) AND `Month` = MONTH(CURDATE() - INTERVAL 1 MONTH)')->get('activity_month_report')->row();
        $currentMonth = $this->db->where('`Year` = YEAR(CURDATE()) AND `Month` = MONTH(CURDATE())')->get('activity_month_report')->row();
        /* array_push($ret,array("title"=>"Total Hours","data"=>$this->db->select('GetFormattedTime(sum(billed_hr)) as total')->get('activities')->row()->total));
          array_push($ret,array("title"=>"Total Activities","data"=>$this->db->select('count(*) as total')->get('activities')->row()->total));
          array_push($ret,array("title"=>"Paid Hours","data"=>$this->db->select('GetFormattedTime(sum(billed_hr)) as total')->where('status',1)->get('activities')->row()->total));
          array_push($ret,array("title"=>"Paid Activities","data"=>$this->db->select('count(*) as total')->where('status',1)->get('activities')->row()->total));
         */
        if (!$previousMonth) {
            return array("prev" => $currentMonth, "current" => $currentMonth);
        } else {
            return array("prev" => $previousMonth, "current" => $currentMonth);
        }
    }

    function get_developer_activity() {
        return $this->db->get('activity_month_report')->result();
    }

}
