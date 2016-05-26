<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class User extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('User_model');
    }
    
    public function  getAllUsers(){
        $userName = $this->input->post('uname');
        $result = $this->User_model->getAllUsers($userName);
        echo json_encode($result);
        
    }
    /*
     
    
    */
    public function getAllUsersWithProjectID()
    {
        $projectId = $this->input->post('projectId');
        $userName = $this->input->post('uname');
        $result = $this->User_model->getAllUsersWithProjectID($projectId,$userName);
        echo json_encode($result);
    }
    
    
    public function  getAllProjectUser() {
        $projectId = $this->input->post('projectId');
        $result = $this->User_model->getAllProjectUser($projectId);
        echo json_encode($result);
    }
/*
 * 输入：uid=test1
 * 接口：user/getPersonalDetail
 * 输出：{"success":true,"errorCode":0,"error":0,"data":{"0":{"FID":"test1","FNUMBER":"\u9676\u6587\u6d01b","FNAME":"test1","FORG":"20140901053445.0Z"},"subscribeAmountTotal":0,"bonusAmountTotal":3,"payAmountTotal":3,"leverageAmountTotal":3,"subscribeProCount":1}}
 * */
    public function  getPersonalDetail()
    {
        
        $userID = $this->input->post('uid');
        $result = $this->User_model->getPersonalDetail($userID);
        echo json_encode($result);
        
    }
    /*
     * 输入：begin=0&count=2&uid=test1&projectId=123
     * 接口：user/getPersonSubscribeDetail
     * 
     * 输出：{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"test1","FUSERID":"test1","FBANKID":"123","FAMOUNT":"3","FLEVERRATIO":"3","FLEVERAMOUNT":"2","FCONFIRMAMOUNT":"1","FLEVERCONFIRMAMOUNT":"4","FPROJECTNAME":"test"}]}
     * */
    public function getPersonSubscribeDetail() {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');
        $result = $this->User_model->getPersonSubscribeDetail($begin,$count,$userID,$projectId);
        echo json_encode($result);
    }


    // user/getUserBaseInfo
    public function getUserBaseInfo()
    {
        $userID = $this->input->post('uid');
         $result = $this->User_model-> getUserBaseInfo($userID);
        echo json_encode($result);
    }
}