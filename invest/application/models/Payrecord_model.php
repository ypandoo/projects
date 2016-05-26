<?php
defined('BASEPATH') or exit('Error');

/**
 *锟缴匡拷锟铰硷拷锟�*/
class Payrecord_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function  addpayDataArry($subscribeConfigrmRecordId, $payTimes,$payAmount,$payDate) {
        $this->load->model('Subscription_model');
        $result = $this->Subscription_model->getSubscriptionDataWithRecordId($subscribeConfigrmRecordId);
        $data = array (
            'FSUBSCRIBECONFIGRMRECORDID' => $subscribeConfigrmRecordId,
            'FPAYTIMES' => $payTimes,
            'FPAYDATE' => date('Y-m-d H:i:s'),
            'FPAYAMOUNT' => $payAmount,
            'FPROJECTNAME' =>$result['FPROJECTNAME'],
            'FPROJECTID' => $result['FPROJECTID'],
            'FUSERID' => $result['FUSERID']
        );
        return $data;
    }
    
    public function addpayList($dataArr) {
        $insertArr = array();
        $result = '';
        foreach ($dataArr as $item) {
            $oneData = $this->addpayDataArry($item['subscribeConfigrmRecordId'], $item['payTimes'], $item['payAmount'], $item['payDate']);
            $result=  $this->db->insert('T_PAYRECORD', $oneData);
            //array_push($insertArr, $oneData);
        }
         
        //$result=  $this->db->insert('T_PAYRECORD', $insertArr);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
    public function getSubscriptionDataWithRecodeID($RecodeID) {
        $this->db->select("*");
        $this->db->where('FSUBSCRIBECONFIGRMRECORDID',$RecodeID);
        $result = $this->db->get('T_PAYRECORD')->result_array();
        return $result;
    }
    
    public function getSubscriptionData($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_PAYRECORD')->result_array();
        return $result[0];
    }

    public function getPayCountWithTime($FID,$time)
    {
        $this->db->select("*");
        $where = 'FSUBSCRIBECONFIGRMRECORDID='.$FID." AND FPAYTIMES = ".$time;
        $this->db->where($where);
        $this->db->from('T_PAYRECORD');
        $result = $this->db->count_all_results();
        return $result;
    }
    
    public function  getPersonPayDetail($begin,$count,$userID,$projectId){
        $tablename = 'T_PAYRECORD';
        $where ='';
        if($projectId){
            $where += 'FPROJECTID = '.$projectId;
        }
        if($userID) {
            $where += ' AND FUSERID ='.$userID;
        }
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $result =  $this->getPageData($tablename, $where, $count, $begin, $this->db);;
       $totalPayAmount = 0;
        if($projectId && $userID) {
            foreach ($result as $item) {
                $totalPayAmount +=intval($item['FPAYAMOUNT']);
            }
        }
        $data['data'] = $result;
        if($totalPayAmount != 0) {
            $data['totalPayAmount'] = $totalPayAmount;
        }
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

    public function getAllPayRecod($projectId)
    {
        $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FCONFIRMAMOUNT";
        $this->db->select($selectData);
        $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
         $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
        $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectId);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }

    public function getAllPayRecodFilds($projectId)
    {
        $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID,T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FCONFIRMAMOUNT";
        $this->db->select($selectData);
        $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
        $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
        $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectId);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->list_fields();
        return $result;
    }

    
    public function getPayRecordListByName($subscribeStartDate, $subscribeEndDate,$userName,$projectId) {
        
        
        $where = 'T_SUBSCRIBECONFIRMRECORD.FPROJECTID='.$projectId;
        if($subscribeStartDate && $subscribeEndDate){
            $startdatetime = new DateTime($subscribeStartDate);
            $startTime= $startdatetime->format('Y-m-d H:i:s');
            $endDatetime = new DateTime($subscribeEndDate);
            $endTime = $endDatetime->format('Y-m-d H:i:s');
            $where = $where." AND '".$startTime."' < DATE_FORMAT(T_PAYRECORD.FPAYDATE,'%Y-%m-%d %H:%i:%s') AND DATE_FORMAT(T_PAYRECORD.FPAYDATE,'%Y-%m-%d %H:%i:%s') <'".$endTime."'";
        }
        $this->db->where($where);
       
        $selectData = "T_PAYRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FCONFIRMAMOUNT,T_PAYRECORD.FPAYTIMES as FPAYTIMES,T_PAYRECORD.FPAYDATE as FPAYDATE,T_PAYRECORD.FPAYAMOUNT as FPAYAMOUNT";
        $this->db->select($selectData);
        $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
        $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
        $this->db->join('T_PAYRECORD','T_PAYRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
        if($userName)
            $this->db->like('FNAME',$userName);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] =  $result;
        return $data;
    }

    public function exportPayRecordXls($subscribeStartDate, $subscribeEndDate,$userName,$projectId)
    {
        $where = 'T_SUBSCRIBECONFIRMRECORD.FPROJECTID='.$projectId;
        if($subscribeStartDate && $subscribeEndDate){
            $startdatetime = new DateTime($subscribeStartDate);
            $startTime= $startdatetime->format('Y-m-d H:i:s');
            $endDatetime = new DateTime($subscribeEndDate);
            $endTime = $endDatetime->format('Y-m-d H:i:s');
            $where = $where." AND '".$startTime."' < DATE_FORMAT(T_PAYRECORD.FPAYDATE,'%Y-%m-%d %H:%i:%s') AND DATE_FORMAT(T_PAYRECORD.FPAYDATE,'%Y-%m-%d %H:%i:%s') <'".$endTime."'";
        }
        $this->db->where($where);
        $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FCONFIRMAMOUNT,T_PAYRECORD.FPAYTIMES as FPAYTIMES,T_PAYRECORD.FPAYDATE as FPAYDATE,T_PAYRECORD.FPAYAMOUNT as FPAYAMOUNT";
        $this->db->select($selectData);
        $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
       $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
        $this->db->join('T_PAYRECORD','T_PAYRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
         if($userName)
                $this->db->like('T_USER.FNAME',$userName);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;

    }

    //获得用户的所有交款记录
    public function getUserPayRecord($userId)
    {
        $where = 'T_SUBSCRIBECONFIRMRECORD.FUSERID='.$userId;
        $this->db->where($where);
        $selectData = "T_PAYRECORD.FID as FID,T_SUBSCRIBECONFIRMRECORD.FCONFIRMAMOUNT as FCONFIRMAMOUNT,T_BONUSRECORD.FBONUSTIMES as FBONUSTIMES,T_BONUSRECORD.FBONUSDATE as FBONUSDATE,T_BONUSRECORD.FBONUSAMOUNT as FBONUSAMOUNT,T_BANKINFO.FBANKNO as FBANKNO";
        $this->db->select($selectData);
        $this->db->join('T_PAYRECORD','T_PAYRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] =  $result;
        return $data;
    }

    public function testSum()
    {
        $this->db->select('sum(FPAYAMOUNT) as total, T_PAYRECORD.FID as FID');
       // $this->db->select('sum('.$sumItem.') as TOTAL'.$sumItem);
        $this->db->where('T_PAYRECORD.FSUBSCRIBECONFIGRMRECORDID',2);
        $this->db->group_by('T_PAYRECORD.FPAYTIMES');
        $result = $this->db->get('T_PAYRECORD')->result_array();
        if($result==NULL) return 0;
        return $result[0]['total'];
    }

    public function getSubscriptionSum($SubscriptionID)
    {
        $this->db->select('sum(FPAYAMOUNT) as TOTALFPAYAMOUNT');
       
        $this->db->where('FSUBSCRIBECONFIGRMRECORDID', $SubscriptionID);
        $this->db->group_by('T_PAYRECORD.FSUBSCRIBECONFIGRMRECORDID');
        $result = $this->db->get('T_PAYRECORD')->result_array();
        if($result==NULL) return 0;
        return $result[0]['TOTALFPAYAMOUNT'];
    }

    public function getPayInDetail($userID)
    {
        $where = 'T_SUBSCRIBECONFIRMRECORD.FUSERID='.$userID;
        $this->db->where($where);
        $selectData = "T_PAYRECORD.FID as FID,T_PROJECT.FNAME as FNAME,T_SUBSCRIBECONFIRMRECORD.FCONFIRMAMOUNT as FCONFIRMAMOUNT,T_PAYRECORD.FPAYTIMES as FPAYTIMES,T_PAYRECORD.FPAYDATE as FPAYDATE,T_PAYRECORD.FPAYAMOUNT as FPAYAMOUNT";
        $this->db->select($selectData);
        $this->db->join('T_PAYRECORD','T_PAYRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
         $this->db->join('T_PROJECT','T_PROJECT.FID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] =  $result;
        return $data;
    }
}