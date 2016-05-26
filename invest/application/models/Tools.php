<?php
class Tools extends CI_Model
{
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
    
    public function getDataTime($inputTime) {
        $datetime = new DateTime($inputTime);
        $time= $datetime->format('Y-m-d H:i:s');
        return $time;
    }
    
    public  function  updateData($data,$tableName,$where) {
        $data_result["success"] = $this->db->update($tableName, $data,$where);
        $data_result["errorCode"] = 0;
        $data_result["error"] = 0;
        $data_result['data'] = '';
        return  $data_result;
    }

     public  function  updateDataWithFID($data,$tableName,$FID) {
        $this->db->where('FID',$FID);
        $data_result["success"] = $this->db->update($tableName, $data);
        $data_result["errorCode"] = 0;
        $data_result["error"] = 0;
        $data_result['data'] = '';
        return  $data_result;
    }
    
    public function addData($data,$tableName) {
       $result=  $this->db->insert($tableName, $data);
       $data_result["success"] = $result;
       $data_result["errorCode"] = 0;
       $data_result["error"] = 0;
       $data_result['data'] = $this->db->insert_id();
       return  $data_result;
    }
    
     public function deleteDataWithWhere($tableName,$where) {
        $this->db->where($where);
        $result=  $this->db->delete($tableName);
        $data_result["success"] = $result;
        $data_result["errorCode"] = 0;
        $data_result["error"] = 0;
        $data_result['data'] = '';
        return  $data_result;
    }

    public function deleteData($data,$tableName) {
        $this->db->where('FID',$data['FID']);
        $result=  $this->db->delete($tableName);
        $data_result["success"] = $result;
        $data_result["errorCode"] = 0;
        $data_result["error"] = 0;
        $data_result['data'] = '';
        return  $data_result;
    }

    public function getData($where,$tableName) {
        $this->db->select('*');
        if($where != null)
          $this->db->where($where);
        $result = $this->db->get($tableName)->result_array();
         $data_result["success"] = true;
        $data_result["errorCode"] = 0;
        $data_result["error"] = 0;
        $data_result['data'] = $result;
         return  $data_result;
    }

    public function AssembleData($result, $success) {
        $data_result["success"] = $success;
        $data_result["errorCode"] = 0;
        $data_result["error"] = 0;
        $data_result['data'] = $result;
        return $data_result;
    }
}