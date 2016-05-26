<?php
/**
 *
 */
class BankInfo_model extends CI_Model
{
    public $FID;
    public $FUSERID;
    public $FBANKNO;
    public $FNAME;
    public $FBANKATTRIBUTE;
    
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function getPersonBankInfo($userID) {
        $this->db->select("*");
        $this->db->where('FUSERID',$userID);
        $result = $this->db->get('T_BANKINFO')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }
    
    public function  addProject($userID,$bankNo,$bankName,$bankAttribute) {
        $this->FUSERID = $userID;
        $this->FBANKNO = $bankNo;
        $this->FNAME = $bankName;
        $this->FBANKATTRIBUTE = $bankAttribute;
        $this->db->insert('T_BANKINFO', $this);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
    public function  deleteBankCardRecord($userID,$bankNo) {
        $this->db->where('FUSERID', $userID);
        $this->db->where('FBANKNO', $bankNo);
        $result =  $this->db->delete('T_BANKINFO');
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
    
    public function  updateBackCard($data) {
        $where = "author_id = 1 AND status = 'active'";
        $data["success"] = $this->db->update_string('table_name', $data, $where);
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '';
        return  $data;
    }
}