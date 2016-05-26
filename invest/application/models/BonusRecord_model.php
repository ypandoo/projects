<?php
defined('BASEPATH') or exit('Error');

class BonusRecord_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function  addpayDataArry($subscribeConfigrmRecordId, $bonusTimes,$bonusAmount,$bonusyDate) {
        $this->load->model('Subscription_model');
        $result = $this->Subscription_model->getSubscriptionDataWithRecordId($subscribeConfigrmRecordId);
        $data = array (
            'FSUBSCRIBECONFIGRMRECORDID' => $subscribeConfigrmRecordId,
            'FBONUSDATE' => $bonusyDate,
            'FBONUSAMOUNT' => $bonusAmount,
            'FPROJECTNAME' =>$result['FPROJECTNAME'],
            'FPROJECTID' => $result['FPROJECTID'],
            'FUSERID' => $result['FUSERID']
        );
        return $data;
    }

    public function getCONFTotalCount($projectID) {
        $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID,SUM(T_SUBSCRIBECONFIRMRECORD.FAMOUNT) as TotalCount";
        $this->db->select($selectData);
        $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        if(!empty($result)) {
            return $result[0]['TotalCount'];
        } else {
            return 0;
        }
    }

    public function updateBonusRecordWithTotalBonues($time,$totalBonus,$projectID) {
        $totalCount = $this->getCONFTotalCount($projectID);
        $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FSUBSCRIBECONFIGRMRECORDID,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FAMOUNT";
        $this->db->select($selectData);
        $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
       // $test['totalCount'] = $totalCount;
        //return $test;
        foreach ($result as $item) {
            $insertArr = array();
            $insertArr['FBONUSAMOUNT'] = $totalBonus * $item['FAMOUNT'] / $totalCount;
            $count = $this->BonusRecord_model->getBonusCountWithTime($item['FSUBSCRIBECONFIGRMRECORDID'],$time);
            $tableName = 'T_BONUSRECORD';
            $this->load->model('Tools');
            
            if(intval($count)>0){
                $where = 'FSUBSCRIBECONFIGRMRECORDID='. $item['FSUBSCRIBECONFIGRMRECORDID'].' AND FBONUSTIMES='. $time;
                $result = $this->Tools->updateData( $insertArr,$tableName,$where);
            } else {
             $insertArr['FSUBSCRIBECONFIGRMRECORDID'] = $item['FSUBSCRIBECONFIGRMRECORDID'];
                $insertArr['FBONUSTIMES'] = $time;
                $result = $this->Tools->addData( $insertArr,$tableName);
            } 
        }
        $this->db->select("*");
        $result = $this->db->get('T_BONUSRECORD')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] =  $result;
        return $data;
       
    }

     public function getBonusCountWithTime($FID,$time)
    {
        $this->db->select("*");
        $where = 'FSUBSCRIBECONFIGRMRECORDID='.$FID." AND FBONUSTIMES = ".$time;
        $this->db->where($where);
        $this->db->from('T_BONUSRECORD');
        $result = $this->db->count_all_results();
        return $result;
    }
    
    public function addBonusList($dataArr) {
        $insertArr = array();
        $result = '';
        foreach ($dataArr as $item) {
        	$oneData = $this->addpayDataArry($item['subscribeConfigrmRecordId'], $item['bonusTimes'], $item['bonusAmount'], $item['bonusyDate']);
        	$result=  $this->db->insert('T_BONUSRECORD', $oneData);
        	//array_push($insertArr, $oneData);
        }
       
        //$result=  $this->db->insert('T_BONUSRECORD', $insertArr);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
    public function getSubscriptionDataWithRecodeID($RecodeID) {
        $this->db->select("*");
        $this->db->where('FSUBSCRIBECONFIGRMRECORDID',$RecodeID);
        $result = $this->db->get('T_BONUSRECORD')->result_array();
        return $result;
    }
    
    public function  getBonusAmountTotal() {
        $query=$this->db->select("*");
        $query = $this->db->get('T_BONUSRECORD');
        $result = $query->result_array();
        $subcribeAmountTotal = 0;
        foreach ( $result as $item) {
            $subcribeAmountTotal += intval($item['FBONUSAMOUNT']);
        }
        return $subcribeAmountTotal;
    }
    public function getPersonBounsDetail($begin,$count,$userID,$projectId){
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
                $totalPayAmount +=intval($item['FBONUSAMOUNT']);
            }
        }
        $data['data'] = $result;
        if($totalPayAmount != 0) {
            $data['totalBonusAmount'] = $totalPayAmount;
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
        
        public function getFollower($FID) {
            $this->db->select("*");
            $this->db->where('FID',$FID);
            $result = $this->db->get('T_PAYRECORD')->result_array();
            return $result[0];
        }

         public function getAllPayRecod($projectId) {
            $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FCONFIRMAMOUNT,T_BANKINFO.FBANKNO as FBANKNO";
            $this->db->select($selectData);
            $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
            $this->db->join('T_BANKINFO','T_BANKINFO.FID=T_SUBSCRIBECONFIRMRECORD.FBANKID');
            $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectId);
            $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
            return $result;
        }

        public function getAllPayRecodFilds($projectId) {
            $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID,T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FCONFIRMAMOUNT";
            $this->db->select($selectData);
            $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
            $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectId);
            $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->list_fields();
            return $result;
        }

    
        public function getBonusRecordListByName($subscribeStartDate, $subscribeEndDate,$userName,$projectId) {
           
            $where = 'T_SUBSCRIBECONFIRMRECORD.FPROJECTID='.$projectId;
            if($subscribeStartDate && $subscribeEndDate){
                $startdatetime = new DateTime($subscribeStartDate);
                $startTime= $startdatetime->format('Y-m-d H:i:s');
                $endDatetime = new DateTime($subscribeEndDate);
                $endTime = $endDatetime->format('Y-m-d H:i:s');
                $where = $where." AND '".$startTime."' < DATE_FORMAT(T_BONUSRECORD.FBONUSDATE,'%Y-%m-%d %H:%i:%s') AND DATE_FORMAT(T_BONUSRECORD.FBONUSDATE,'%Y-%m-%d %H:%i:%s') <'".$endTime."'";
            }
             $this->db->where($where);
            $selectData = "T_BONUSRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FCONFIRMAMOUNT,T_BONUSRECORD.FBONUSTIMES as FBONUSTIMES,T_BONUSRECORD.FBONUSDATE as FBONUSDATE,T_BONUSRECORD.FBONUSAMOUNT as FBONUSAMOUNT,T_BANKINFO.FBANKNO as FBANKNO";
            $this->db->select($selectData);
            $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
           $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
            $this->db->join('T_BANKINFO','T_BANKINFO.FID=T_SUBSCRIBECONFIRMRECORD.FBANKID');
            $this->db->join('T_BONUSRECORD','T_BONUSRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
            if($userName)
                $this->db->like('T_USER.FNAME',$userName);
            $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
            $data["success"] = true;
            $data["errorCode"] = 0;
            $data["error"] = 0;
            $data['data'] =  $result;
            return $data;
        }

        public function exportBonusRecordXls($subscribeStartDate, $subscribeEndDate,$userName,$projectId) {

            $where = 'T_SUBSCRIBECONFIRMRECORD.FPROJECTID='.$projectId;
            if($subscribeStartDate && $subscribeEndDate){
                $startdatetime = new DateTime($subscribeStartDate);
                $startTime= $startdatetime->format('Y-m-d H:i:s');
                $endDatetime = new DateTime($subscribeEndDate);
                $endTime = $endDatetime->format('Y-m-d H:i:s');
                $where = $where." AND '".$startTime."' < DATE_FORMAT(T_BONUSRECORD.FBONUSDATE,'%Y-%m-%d %H:%i:%s') AND DATE_FORMAT(T_BONUSRECORD.FBONUSDATE,'%Y-%m-%d %H:%i:%s') <'".$endTime."'";
            }
            $this->db->where($where);
            $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FCONFIRMAMOUNT,T_BONUSRECORD.FBONUSTIMES as FBONUSTIMES,T_BONUSRECORD.FBONUSDATE as FBONUSDATE,T_BONUSRECORD.FBONUSAMOUNT as FBONUSAMOUNT";
            $this->db->select($selectData);
            $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
            $this->db->join('T_BONUSRECORD','T_BONUSRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
            if($userName)
                $this->db->like('T_USER.FNAME',$userName);
            $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
            return $result;
        }

        //获得用户的所有分红记录
        public function getUserBonusRecord($userId)
        {
            $where = 'T_SUBSCRIBECONFIRMRECORD.FUSERID='.$userId;
            $this->db->where($where);
            $selectData = "T_BONUSRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,ifNULL(T_SUBSCRIBECONFIRMRECORD.FAMOUNT, 0) as FCONFIRMAMOUNT,T_BONUSRECORD.FBONUSTIMES as FBONUSTIMES,T_BONUSRECORD.FBONUSDATE as FBONUSDATE,ifNULL(T_BONUSRECORD.FBONUSAMOUNT, 0) as FBONUSAMOUNT";
            $this->db->select($selectData);
            $this->db->join('T_BONUSRECORD','T_BONUSRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
            $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID AND T_FOLLOWER.FPROJECTID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
            $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
            $data["success"] = true;
            $data["errorCode"] = 0;
            $data["error"] = 0;
            $data['data'] =  $result;
            return $data;
        }

         public function getBonusSubscriptionSum($SubscriptionID)
    {
        $this->db->select('sum(FBONUSAMOUNT) as TOTALFBONUSAMOUNT');
        $this->db->where('FSUBSCRIBECONFIGRMRECORDID', $SubscriptionID);
        $this->db->group_by('T_BONUSRECORD.FSUBSCRIBECONFIGRMRECORDID');
        $result = $this->db->get('T_BONUSRECORD')->result_array();
        if($result==NULL) return 0;
        return $result[0]['TOTALFBONUSAMOUNT'];
    }

    public function getBonusDetail($userID) {
        $where = 'T_SUBSCRIBECONFIRMRECORD.FUSERID='.$userID;
        $this->db->where($where);
        $selectData = "T_BONUSRECORD.FID as FID,T_PROJECT.FNAME as FNAME,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FCONFIRMAMOUNT,T_BONUSRECORD.FBONUSTIMES as FBONUSTIMES,T_BONUSRECORD.FBONUSDATE as FBONUSDATE,T_BONUSRECORD.FBONUSAMOUNT as FBONUSAMOUNT,T_BANKINFO.FBANKNO as FBANKNO";
        $this->db->select($selectData);
        $this->db->join('T_BONUSRECORD','T_BONUSRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
        $this->db->join('T_PROJECT','T_PROJECT.FID=T_SUBSCRIBECONFIRMRECORD.FPROJECTID');
        $this->db->join('T_BANKINFO','T_BANKINFO.FID=T_SUBSCRIBECONFIRMRECORD.FBANKID');
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] =  $result;
        return $data;
    }
}