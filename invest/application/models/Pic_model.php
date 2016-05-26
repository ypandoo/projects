<?php


class Pic_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }

    public function getPic($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_PIC')->result_array();
        return $result[0];
    }
    
    public function getProjectID($FPROJECTID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$FPROJECTID);
        $result = $this->db->get('T_PIC')->result_array();
        return $result;
    }

    public function getPicListWithProjectID($projectID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectID);
        $result = $this->db->get('T_PIC')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data; ;
    }
    
    public function  addPic($projectID,$picName,$picURL){
        $insertArry = array(
            'FPROJECTID'=>$projectID,
            'FNAME' =>$picName,
            'FCONTENT' => $picURL,
            'FISMAINPIC' => false,
        );
        $this->db->insert('T_PIC', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }

    public function addMainImages($projectID,$picName,$picURL)
    {
         $insertArry = array(
            'FPROJECTID'=>$projectID,
            'FNAME' =>$picName,
            'FCONTENT' => $picURL,
            'FISMAINPIC' => true,
            
        );
        $this->db->insert('T_PIC', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }

    public function getMainImage($projectId){
        $where = 'FPROJECTID='.$projectId.' AND FISMAINPIC=true';
        $this->db->select( "*");
        $this->db->where($where);
        $result = $this->db->get('T_PIC')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data; 
    }

   
    public function getAllProjectImage($projectId){
        $where = 'FPROJECTID='.$projectId.' AND FISMAINPIC=false';
        $this->db->select( "*");
        $this->db->where($where);
        $result = $this->db->get('T_PIC')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data; 
    }


}