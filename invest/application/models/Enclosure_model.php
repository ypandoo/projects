<?php
/**
 *
 */
class Enclosure_model extends CI_Model
{
    public $FID;
    public $FPROJECTID;
    public $EnclosurePath;
    
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function getEnclosure($FPROJECTID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$FPROJECTID);
        $result = $this->db->get('T_Enclosure')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }
    
    public function  addEnclosure($FPROJECTID,$EnclosurePath) {
        $this->FPROJECTID = $FPROJECTID;
        $this->EnclosurePath = $EnclosurePath;
        $data["success"] = $this->db->insert('T_Enclosure', $this);
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
    public function  deleteEnclosure($FPROJECTID,$EnclosurePath) {
        $this->db->where('FPROJECTID', $FPROJECTID);
        $result =  $this->db->delete('T_Enclosure');
        $data["success"] = $this->db->delete('T_Enclosure');
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '';
        return  $data;
    }
}