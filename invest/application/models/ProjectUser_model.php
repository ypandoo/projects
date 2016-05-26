<?php


class ProjectUser_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function  countUserInProject($userID,$projectID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectID);
        $this->db->where('$userID',FUSERID);
        $result = $this->db->get('T_PROJECT_USER')->count_all_results();
        return $result;
    }

    public function getFollower($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_PROJECT_USER')->result_array();
        return $result[0];
    }
    
    public function getFollowerList($projectID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectID);
        $result = $this->db->get('T_PROJECT_USER')->result_array();
        return $result;
    }

    public function  addFollower($dataArry){
        $insertArry = array(
            'FPROJECTID'=>$dataArry['FPROJECTID'],
            'FUSERID' =>$dataArry['FUSERID'],
        );
        $this->db->insert('T_PROJECT_USER', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
}