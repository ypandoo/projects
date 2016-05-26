<?php
defined('BASEPATH') or exit('Error');

/**
 *
*/
class User_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
        $this->load->model('Tools');
    }
    public function  getAllUsers($userName){
        if($userName) {
            $this->db->where('FNAME',$userName);
        }
        $this->db->select("*");
        $result = $this->db->get('T_USER')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }

    public function checkLogin($userName, $password) {
        $this->db->select("*");
        if($userName) {
            $this->db->where('FNUMBER',$userName);
        }
        $result = $this->db->get('T_USER')->result_array();
        $result[0]['FUSERRIGHT'] = '0';
        if($result != NULL && $result[0] != NULL){
            //echo $result;
            $this->db->select("*");
            $this->db->where('FUSERID',$result[0]['FID']);
            $rowNum = $this->db->get('T_USERPROJECTRIGHT')->num_rows();
            if($rowNum != 0) {
                $result[0]['FUSERRIGHT'] = '1';
            } 
        }
        $data["errorCode"] = 0;
        $data["error"] = 0;
        if($result != NULL) {
            $data['data'] = $result;
            $data["success"] = true;
        } else {
             $data['data'] = $result;
            $data["success"] = false;
        }
        return  $data;
    }
    
    public function getUser($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_USER')->result_array();
        $data["errorCode"] = 0;
        $data["error"] = 0;
        if($result != NULL) {
            $data['data'] = $result;
            $data["success"] = true;
        } else {
             $data['data'] = $result;
            $data["success"] = false;
        }
        return $data;
    }
    
    public function  addUser($dataArry){
        $insertArry = array(
            'FNUMBER'=>$dataArry['FNUMBER'],
            'FNUMBER' =>$dataArry['FNUMBER'],
            'FORG' => $dataArry['FORG']
        );
        $this->db->insert('T_USER', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
    
    public function getPersonalDetail($userID) {
        $this->db->select("*");
        $this->db->where('FID',$userID);
        $result = $this->db->get('T_USER')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $this->load->model('Subscription_model');
        $SubscriptionArray = $this->Subscription_model->getSubscriptionDataWithUserID($userID);
        $bonusAmountTotal = 0;
        $subscribeAmountTotal = 0;
        $payAmountTotal = 0;
        $leverageAmountTotal = 0;
        $subscribeProCount = 0;
        foreach ($SubscriptionArray as $item) {
            $subscribeProCount ++;
            $fID = $item['FID'];
            $this->load->model('BonusRecord_model');
            $recodeArray = $this->BonusRecord_model->getSubscriptionDataWithRecodeID($fID);
            foreach ($recodeArray as $recodeItem) {
                $bonusAmountTotal += intval($recodeItem['FBONUSAMOUNT']);
            }
            $this->load->model('PayRecord_model');
            $recodeArray = $this->PayRecord_model->getSubscriptionDataWithRecodeID($fID);
            foreach ($recodeArray as $recodeItem) {
                $payAmountTotal += intval($recodeItem['FPAYAMOUNT']);
            }
            $leverageAmountTotal += intval($item['FAMOUNT']);
        }
        $result['subscribeAmountTotal'] = $subscribeAmountTotal;
        $result['bonusAmountTotal'] = $bonusAmountTotal;
        $result['payAmountTotal'] = $payAmountTotal;
        $result['leverageAmountTotal'] = $leverageAmountTotal;
        $result['subscribeProCount'] = $subscribeProCount;
        $data['data'] = $result;
        return $data;
    }
    
    public function  getPersonSubscribeDetail($begin,$count,$userID,$projectId) {
       
        $tablename = 'T_SUBSCRIBECONFIRMRECORD';
        $where ='';
        if($projectId){
           $where += 'FPROJECTID = '.$projectId;
        }
        if($userID) {
            $where += ' AND FCREATORID ='.$userID;
        }
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $this->getPageData($tablename, $where, $count, $begin, $this->db);;
        return $data;
    }
    
    public function getPageData($tablename, $where, $limit, $offset, $db)
    {
        if(empty($tablename))
        {
            return FALSE;
        }
         
        $dbhandle = empty($db) ? $this->db : $db;
         
        if($where)
        {
            if(is_array($where))
            {
                $dbhandle->where($where);
            }
            else
            {
                $dbhandle->where($where, NULL, false);
            }
        }
         
        $db = clone($dbhandle);
         
        if($limit)
        {
            $db->limit($limit);
        }
         
        if($offset)
        {
            $db->offset($offset);
        }
         
        $data = $db->get($tablename)->result_array();
         
        return $data;
    }
    public function getAllProjectUser($projectID) {
        $query=$this->db->select("*");
        $query=$this->db->where('FPROJECTID',$projectID);
        $query=$this->db->join('T_USER', 'T_USER.FID=T_PROJECT_USER.FUSERID');
        $query=$this->db->get('T_PROJECT_USER');
        $result = $query->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }

    public function getAllUsersWithProjectID($projectId,$userName) {
        $followerList = $this->getFollorUserIDList($projectId);
        $allUser = $this->getUserList($userName);
        $insertArry = array();
        foreach ($allUser as $userKey=>$userValue)
        {
            $flag = 1;
            foreach ($followerList as $fkey => $fvalue) {
                if($fvalue['userID'] == $userValue['FID'])
                {
                    unset($allUser[$userKey]);
                    $flag = 0;
                    break;
                }
            }
            if($flag) {
                if($userValue['F1'] != NULL && $userValue['F2'] != NULL)
                    $userValue['FORG'] = $userValue['F1']."/".$userValue['F2'];
                if($userValue['F1'] != NULL && $userValue['F2'] != NULL)
                    array_push($insertArry, $userValue);
            }
        }
       
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $insertArry;
        return $data;
    }
    public function getFollorUserIDList($projectId){
        $this->db->select("T_FOLLOWER.FUSERID as userID");
        $this->db->where('FPROJECTID',$projectId);
        $result = $this->db->get('T_FOLLOWER')->result_array();
        return $result;
    }

    public function getUserList($userName) {
        $this->db->select("*");
        if($userName)
            $this->db->like('FNAME',$userName);
        $result = $this->db->get('T_USER')->result_array();
        return $result;
    }


    public function getUserBaseInfo($userID)
    {
        $result;
        //个人的认购项目数
        $query = $this->db->query('select FUSERID,count(FPROJECTID),FPROJECTID from T_SUBSCRIBECONFIRMRECORD where FUSERID ='.$userID.' group by FPROJECTID');
        $arr=$query->num_rows();
        if($arr != NULL){
            $result['FPROJECTCOUNT'] = $arr;
        }  else {
            $result['FPROJECTCOUNT'] = 0;
        }

        //个人缴款总额
         $query = $this->db->query('select SUM(T_PAYRECORD.FPAYAMOUNT) as  TATOLFPAYAMOUNT from T_PAYRECORD JOIN T_SUBSCRIBECONFIRMRECORD ON T_SUBSCRIBECONFIRMRECORD.FID = T_PAYRECORD.FSUBSCRIBECONFIGRMRECORDID where T_SUBSCRIBECONFIRMRECORD.FUSERID = '.$userID);
        $arr=$query->result_array();
        if($arr != NULL &&  $arr[0] != NULL){
            $result['TATOLFPAYAMOUNT'] = $arr[0]['TATOLFPAYAMOUNT'];
        }  else {
            $result['TATOLFPAYAMOUNT'] = 0;
        }
 
        //个人跟投总额(万元) 

         $query = $this->db->query("select  SUM(FAMOUNT+FLEVERAMOUNT) as FTOTALAMOUNT from T_SUBSCRIBECONFIRMRECORD where FUSERID =".$userID);
        $arr=$query->result_array();
        if($arr != NULL &&  $arr[0] != NULL){
            $result['FTOTALAMOUNT'] = $arr[0]['FTOTALAMOUNT'];
        } else {
            $result['FTOTALBONUSAMOUNT'] = 0;
        }

        //个人分红总额
        $query = $this->db->query(" select  SUM(FBONUSAMOUNT) as FTOTALBONUSAMOUNT from T_BONUSRECORD JOIN T_SUBSCRIBECONFIRMRECORD ON T_SUBSCRIBECONFIRMRECORD.FID = T_BONUSRECORD.FSUBSCRIBECONFIGRMRECORDID where T_SUBSCRIBECONFIRMRECORD.FUSERID = ".$userID);
        $arr=$query->result_array();
        if($arr != NULL &&  $arr[0] != NULL){
            $result['FTOTALBONUSAMOUNT'] = $arr[0]['FTOTALBONUSAMOUNT'];
        } else {
            $result['FTOTALBONUSAMOUNT'] = 0;
        }

        //个人杠杆认购总额
         $query = $this->db->query("select  SUM(FLEVERAMOUNT) as FTOTALFLEVERAMOUNT from T_SUBSCRIBECONFIRMRECORD where FUSERID =".$userID);
        $arr=$query->result_array();
         if($arr != NULL &&  $arr[0] != NULL){
            $result['FTOTALFLEVERAMOUNT'] = $arr[0]['FTOTALFLEVERAMOUNT'];
        } else {
            $result['FTOTALFLEVERAMOUNT'] = 0;
        }
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
}