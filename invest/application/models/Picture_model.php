<?php
defined('BASEPATH') or exit('Error');

/**
 *
*/
class Picture_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    public function getPictureWithProjectID($projectID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectID);
        $this->db->where('FISMAINPIC',true);
        $result = $this->db->get('T_PIC')->result_array();
        return $result;
    }
}