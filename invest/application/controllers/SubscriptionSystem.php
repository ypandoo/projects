<?php
defined('BASEPATH') or exit('Error!');
class SubscriptionSystem extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('Tools');
    }
    /*
     * 
     * 参数：uid=test1
     * 接口：SubscriptionSystem/getSubscriptionSystemInfo
     * 输出：{"test":"test1"}
     * */
    public function  getSubscriptionSystemInfo() {
    
        $where = 'FID=1';
        $tableName = 'T_SUBSCRIPTIONSYSTEM';
        $result = $this->Tools->getData($where,$tableName);
        echo json_encode($result);
    }
  
     /* 
     * 更新跟投制度
     * 接口：SubscriptionSystem/updateSubscriptionSystemInfo
     * 
     * */
    public function updateSubscriptionSystemInfo() {
    
        
        $data = $this->input->input_stream();
        $where = 'FID=1';
        $tableName = 'T_SUBSCRIPTIONSYSTEM';
        $result = $this->Tools->updateData($data,$tableName,$where);
        echo json_encode($result);
    }
    
    
 }
    