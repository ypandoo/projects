<?php
defined('BASEPATH') or exit('Error');

/**
 *
*/
class Subscription_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }

    /*
        status : 0 默认状态，1 已经认购，2 未完成认购
    */

    public function getSubscription($userId,$status){
        
        $this->load->model('Follower_model');
        $this->load->model('Project_model');
        $FollowerList = $this->Follower_model->getProjectWithUserID($userId);
        $resultArr = array();
        foreach ($FollowerList as $item) {
            if($item['FPROJECTID']) {
                $where = ' FPROJECTID='.$item['FPROJECTID'];
            }
            if(!isSubscriptionProject($userId,$item['FPROJECTID'],$status)) continue;
            $projectName = null;
            $tempItem = $$this->Project_model->getProjectListWithID($where,$item['FPROJECTID'],$projectName);
            $tempItem['FID'] = $item['FPROJECTID'];
            $tempItem['HDAmount'] = 3;
            $tempItem['regioAmount'] = 3;
            $tempItem['HDAmountComplete'] = "test";
            $tempItem['regioAmountComplete'] = "test";// 临时数据，还没有加入照片
            array_push($resultArr, $tempItem);
        }
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] =  $resultArr;
        return $data;
       
    }

    public function isSubscriptionProject($userID,$projecID,$status)
    {
        $flag = intval($status);
        if($flag == 0) return true;
        $this->db->select("*");
        $where = 'FUSERID='.$userID." AND FPROJECTID = ".$projecID;
        $this->db->where($where);
        $this->db->from('T_SUBSCRIBECONFIRMRECORD');
        $result = $this->db->count_all_results();
        if(($flag == 1&& $result > 0) ||($flag == 2 && $result ==0))  return true;
        return false;
    }

    public function getSubscribeList($projectId)
    {
        $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID,T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FAMOUNT,T_SUBSCRIBECONFIRMRECORD.FLEVERAMOUNT as FLEVERAMOUNT,T_SUBSCRIBECONFIRMRECORD.FCONFIRMAMOUNT as FCONFIRMAMOUNT,T_SUBSCRIBECONFIRMRECORD.FLEVERCONFIRMAMOUNT as FLEVERCONFIRMAMOUNT,T_SUBSCRIBECONFIRMRECORD.FLEVERRATIO as FLEVERRATIO,T_BANKINFO.FBANKNO as FBANKNO";
        $this->db->select($selectData);
        $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
        $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
        $this->db->join('T_BANKINFO','T_BANKINFO.FID=T_SUBSCRIBECONFIRMRECORD.FBANKID');
        $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectId);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
    
    public function getSubscriptionDataWithRecordId($RecordId) {
        $this->db->select("*");
        $this->db->where('FID',$RecordId);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result[0];
    }
    
    public function getSubscriptionDataWithProjectID($projectID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }
    public function getSubscriptionDataWithUserID($userID) {
        $this->db->select("*");
        $this->db->where('FUSERID',$userID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }
    
    public function getSubscriptionDataWithBankID($BankID) {
        $this->db->select("*");
        $this->db->where('FBANKID',$BankID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }
    
    public function getPeopleCount()
    {
        $this->db->select("*");
        return $this->db->get('T_SUBSCRIBECONFIRMRECORD')->num_rows();
    }
    
    public function getSubcribeAmountTotal()
    {
        $this->db->select("*");
        
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        $subcribeAmountTotal = 0;
        foreach ( $result as $item) {
            $subcribeAmountTotal += intval($item['FAMOUNT']) + intval($item['FLEVERAMOUNT']);
        }
        return $subcribeAmountTotal;
    }
    
    public function  getStatisticDetail() {
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $this->load->model("Project_model");
        $result['projectCount'] = $this->Project_model->getProjectTotalNum();
        $result['peopleCount'] = $this->getPeopleCount();
        $result['subcribeAmountTotal'] = $this->getSubcribeAmountTotal();
        $this->load->model("BonusRecord_model");
        $result['bonusAmountTotal'] = $this->BonusRecord_model->getBonusAmountTotal();
        $data['data'] = $result;
        return $data;
    }
    
    public  function  applySubscribe($userID, $projectID, $subscribeAmount, $subscribeRatio, $bankId) {
    	$this->load->model('Project_model');
        $project = $this->Project_model->getProjectInfoWithProjectID($projectID);
        $insertArr = array(
            'FPROJECTID' => $projectID,
            'FUSERID' => $userID,
            'FBANKID' => $bankId,
            'FAMOUNT' => 'test',
            'FLEVERRATIO' => $subscribeRatio,
            'FLEVERAMOUNT' => 'test',
            'FCONFIRMAMOUNT' => 'test',
            'FLEVERCONFIRMAMOUNT' => 'test',
            'FPROJECTNAME' => $project['FNAME']
        );
        $result=  $this->db->insert('T_SUBSCRIBECONFIRMRECORD', $insertArr);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
    //获得已经认购的信息
    public function getHasSubscribe($userID){
        $selectData = 'T_SUBSCRIBECONFIRMRECORD.FID as FID ,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FAMOUNT,T_SUBSCRIBECONFIRMRECORD.FCONFIRMAMOUNT as FCONFIRMAMOUNT,T_SUBSCRIBECONFIRMRECORD.FLEVERCONFIRMAMOUNT as FLEVERCONFIRMAMOUNT,T_SUBSCRIBECONFIRMRECORD.FCREATETIME as FCREATETIME,T_SUBSCRIBECONFIRMRECORD.FLEVERAMOUNT as FLEVERAMOUNT,T_BANKINFO.FBANKNO as FBANKNO,T_PROJECT.FNAME as FNAME,T_SUBSCRIBECONFIRMRECORD.FSTATE as FSTATE';
        $this->db->select($selectData);
        $this->db->where('T_SUBSCRIBECONFIRMRECORD.FUSERID',$userID);
        $this->db->join('T_PROJECT','T_PROJECT.FID = T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
        $this->db->join('T_BANKINFO','T_BANKINFO.FID = T_SUBSCRIBECONFIRMRECORD.FBANKID');
        $this->db->group_by("T_SUBSCRIBECONFIRMRECORD.FID"); 
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        $this->load->model('Payrecord_model');
        $this->load->model('BonusRecord_model');
        $insertArr =  array();
        foreach ($result as $item) {
            $item['TOTALFBONUSAMOUNT'] = $this->Payrecord_model->getSubscriptionSum($item['FID']);
            $item['TOTALFPAYAMOUNT'] = $this->BonusRecord_model->getBonusSubscriptionSum($item['FID']);
            array_push($insertArr,  $item);
        }
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] =  $insertArr;
        return $data;
    }

     public function getRecordInfo($T_SUBSCRIBECONFIRMRECORDID,$table,$sumItem) {
        $this->db->select('*');
       // $this->db->select('sum('.$sumItem.') as TOTAL'.$sumItem);
        $this->db->where('FSUBSCRIBECONFIGRMRECORDID', $T_SUBSCRIBECONFIRMRECORDID);
        $result = $this->db->get($table)->result_array();
        return $result[0];
    }

     public function getSumRecordInfo($T_SUBSCRIBECONFIRMRECORDID,$table,$sumItem) {
        $this->db->select('sum(FBONUSAMOUNT)');
       // $this->db->select('sum('.$sumItem.') as TOTAL'.$sumItem);
        $this->db->where('FSUBSCRIBECONFIGRMRECORDID', $T_SUBSCRIBECONFIRMRECORDID);
        $result = $this->db->get($table)->result_array();
        return $result[0];
    }
}