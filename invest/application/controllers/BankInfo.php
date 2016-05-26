<?php
defined('BASEPATH') or exit('Error!');
class BankInfo extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('BankInfo_model');
    }
    /*
     * 
     * 参数：uid=test1
     * 接口：bankInfo/getPersonBankInfo
     * 输出：{"test":"test1"}
     * */
    public function  getPersonBankInfo() {
    
        $userID = $this->input->post('uid');
        $result = $this->BankInfo_model->getPersonBankInfo($userID);
        echo json_encode($result);
    }
    /*
     * 参数：uid=123&bankNo=123456&bankName=sadfasf&bankAttribute=sadfsa
     * 接口：BankInfo/addBankCardRecord
     * 输出：{"success":true,"errorCode":0,"error":0,"data":"0"}
     * */
    public function  addBankCardRecord()
    {
         
        $userID = $this->input->post('uid');
        $bankNo = $this->input->post('bankNo');
        $bankName = $this->input->post('bankName');
        $bankAttribute = $this->input->post('bankAttribute');
    
        $result = $this->BankInfo_model->addProject($userID,$bankNo,$bankName,$bankAttribute);
        echo  json_encode($result);
    }
    /*
     * 参数：uid=123&bankNo=123456
     * 接口：BankInfo/deleteBankCardRecord
     * 输出：{"success":true,"errorCode":0,"error":0,"data":true}
     * */
    public function  deleteBankCardRecord()
    {
         
        $userID = $this->input->post('uid');
        $bankNo = $this->input->post('bankNo');
    
        $result = $this->BankInfo_model->deleteBankCardRecord($userID,$bankNo);
        echo  json_encode($result);
    }
    
    public function deleteBankInfo() {
        $data = $this->input->input_stream();
        $tableName = 'T_BANKINFO';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
    }
    
    public function updateBankInfo() {
    
        
        $data = $this->input->input_stream();
        $where = 'FID='.$data['FID'];
        $tableName = 'T_BANKINFO';
        $this->load->model('Tools');
        $result = $this->Tools->updateData($data,$tableName,$where);
        echo json_encode($result);
    }
    
    public function addBankInfo() {
        $data = $this->input->input_stream();
        $tableName = 'T_BANKINFO';
        $this->load->model('Tools');
        $result = $this->Tools->addData($data,$tableName);
        echo json_encode($result);
    }
 }
    