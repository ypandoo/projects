<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Subscription extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('Subscription_model');
    }

    public function index()
    {
        # code...
        $this->load->view('Subscription_model');
         
    }
// Subscription/getSubscription
    public function getSubscription()
    {
        $userId = $this->input->post('userId');
        $status = $this->input->post('status');
        $result = $this->Subscription_model->getSubscription($userId,$status);
        echo  json_encode($result);
    }

/*
 * 
 * 
 * subscription/getStatisticDetail
 *{"success":true,"errorCode":0,"error":0,"data":{"projectCount":1,"peopleCount":1,"subcribeAmountTotal":5,"bonusAmountTotal":3}}
 * */
    public function  getStatisticDetail()
    {
        $result = $this->Subscription_model->getStatisticDetail();
        echo  json_encode($result);
    }
    public function  getProjectDetail()
    {

        $projectId = $this->input->post('projectId');
        $fields = $this->input->post('fields');
        $result = $this->project_model->getProjectDetailInfo($projectId,$fields);
        echo  json_encode($result);
    }

   // subscription/getSubscribeList
    public function getSubscribeList()
    {
         $projectId = $this->input->post('projectId');

          $result = $this->Subscription_model->getSubscribeList($projectId);
        echo  json_encode($result);
    }
    
    public function  applySubscribe()
    {
        $userID = $this->input->post('uid');
        $projectID = $this->input->post('projectId');
        $subscribeAmount = $this->input->post('subscribeAmount');
        $subscribeRatio = $this->input->post('subscribeRatio');
        $bankID = $this->input->post('bankId');
        $result = $this->Subscription_model->applySubscribe($userID, $projectID, $subscribeAmount, $subscribeRatio, $bankID);
        echo  json_encode($result);
    }
     
    public function addSubscribe()
    {
        $data = $this->input->input_stream();
        $tableName = 'T_SUBSCRIBECONFIRMRECORD';
        $this->load->model('Tools');
        $result = $this->Tools->addData($data,$tableName);
		/*if($result){
			$inserdata['FSUBSCRIBECONFIGRMRECORDID'] = $result['data'];
			$inserdata['FBONUSAMOUNT'] = 0;
			$inserdata['FBONUSTIMES'] = 0;
			$tableName = 'T_BONUSRECORD';
			$this->load->model('Tools');
			$result = $this->Tools->addData($data,$tableName);
		}*/
        echo json_encode($result);
    }

    //获得已经认购信息
    // SubscriptiogetHasSubscriben/
    public function getHasSubscribe()


    
    {
        $userID = $this->input->post('uid');
        $result = $this->Subscription_model->getHasSubscribe($userID);
        echo  json_encode($result);
    }


// 更新认购表信息
    //subscription/updateSubscribe
    public function updateSubscribe() {
        $data = $this->input->input_stream();
        $where = 'FID='.$data['FID'];
        $tableName = 'T_SUBSCRIBECONFIRMRECORD';
        $this->load->model('Tools');
        $result = $this->Tools->updateData($data,$tableName,$where);
        echo json_encode($result);
    }


}