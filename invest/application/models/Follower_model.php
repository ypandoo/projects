<?php


class Follower_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }

    public function getFollower($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_FOLLOWER')->result_array();
        return $result[0];
    }

    public function  addFollower($dataArry){
        $insertArry = array(
            'FPROJECTID'=>$dataArry['FPROJECTID'],
            'FUSERID' =>$dataArry['FUSERID'],
            'FSEQ' => $dataArry['FSEQ'],
            'FSTATE' => $dataArry['FSTATE'],
            'FDUTY' => $dataArry['FDUTY'],
            'FTOPLIMIT' => $dataArry['FTOPLIMIT'],
            'FDOWNLIMT' => $dataArry['FDOWNLIMT'],
            'FREMARK'=>$dataArry['FREMARK']
        );
        $this->db->insert('T_FOLLOWER', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
    
    public function getProjectID($FPROJECTID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$FPROJECTID);
        $result = $this->db->get('T_FOLLOWER')->result_array();
        return $result;
    }

    public function getProjectWithUserID($userID) {
        $this->db->select("*");
        $this->db->where('FUSERID',$userID);
        $result = $this->db->get('T_FOLLOWER')->result_array();
        return $result;
    }
    
    public function getFollowerListWithProjectID($projectID) {
        $query=$this->db->select("*");
        $query=$this->db->where('FPROJECTID',$projectID);
        $query=$this->db->join('T_FOLLOWER','T_USER.FID=T_FOLLOWER.FUSERID');
        $query=$this->db->get('T_USER');
        $result = $query->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data; ;
    }

    public function getFollowerWithProjectIDAndUserID($projectID,$userID)
    {
        $query=$this->db->select("*");
        $query=$this->db->where('FPROJECTID',$projectID);
        $query=$this->db->where('FUSERID',$userID);
     
        $query=$this->db->get('T_FOLLOWER');
        $result = $query->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
}