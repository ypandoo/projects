<?php

class FollowAgreement_model extends CI_Model
{
    public $FPROJECTID;
    public $FSUBSCRIBESTARTDATE;
    public $FSUBSCRIBEENDDATE;
    public $FPAYSTARTDATE;
    public $FPAYENDDATE;
    public $FFUNDPEAKE;
    public $FHDRATIO;
    public $FHDAMOUNT;
    public $FREGIONRATIO;
    public $FREGIONAMOUNT;
    public $FALLRATION;
    public $FALLAMOUNT;
    public $FLEVERAGEDES;
    public $FFOLLOWTEAM;
    public $FCOLLECTWAY;

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }

    public function getPersonBankInfo($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_FOLLOWAGREEMENT')->result_array();
        return $result[0];
    }

    public function  addFollowScheme($dataArry){
        $insertArry = array(
            'FPROJECTID'=>$dataArry['FPROJECTID'],
            'FCREATORID' =>$dataArry['FCREATORID'],
            'FNAME' => $dataArry['FNAME'],
            'FDETAIL' => $dataArry['FDETAIL'],
        );
        $this->db->insert('T_FOLLOWAGREEMENT', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
}