<?php
class FollowScheme_model extends CI_Model
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
    
    public function getProjectID($FPROJECTID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$FPROJECTID);
        $result = $this->db->get('T_FOLLOWAGREEMENT')->result_array();
        return $result;
    }

    public function getPersonBankInfo($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_FOLLOWSCHEME')->result_array();
        return $result[0];
    }
    
    public function  addFollowScheme($dataArry){
        $insertArry = array(
        'FPROJECTID'=>$dataArry['FPROJECTID'],
        'FSUBSCRIBESTARTDATE' =>$dataArry['FSUBSCRIBESTARTDATE'],
        'FSUBSCRIBEENDDATE' => $dataArry['FSUBSCRIBEENDDATE'],
        'FPAYSTARTDATE' => $dataArry['FPAYSTARTDATE'],
        'FPAYENDDATE' => $dataArry['FPAYENDDATE'],
        'FFUNDPEAKE' => $dataArry['FFUNDPEAKE'],
        'FHDRATIO' => $dataArry['FHDRATIO'],
         'FHDAMOUNT'=>$dataArry['FHDAMOUNT'],
        'FREGIONRATIO'=>$dataArry['FREGIONRATIO'],
        'FREGIONAMOUNT'=>$dataArry['FREGIONAMOUNT'],
        'FALLRATION' =>$dataArry['FALLRATION'],
        'FALLAMOUNT'=>$dataArry['FALLAMOUNT'],
       'FLEVERAGEDES' =>$dataArry['FLEVERAGEDES'],
        'FFOLLOWTEAM'=>$dataArry['FFOLLOWTEAM'],
        'FCOLLECTWAY'=>$dataArry['FCOLLECTWAY']
        );
        $this->db->insert('T_FOLLOWSCHEME', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
    
    public function getFollowerSchemeListWithProjectID($projectID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectID);
        $result = $this->db->get('T_FOLLOWSCHEME')->result_array();
    
        $selectData = 'SUM(FAMOUNT+FLEVERAMOUNT)';
        $result[0]['TATOLHASHDSU'] = $this->getSUBSCRIBECONFIRMData($projectID,'总部',$selectData);
        $selectData = 'SUM(FAMOUNT)';
        $result[0]['TATOLHASHDPERSONSU'] = $this->getSUBSCRIBECONFIRMData($projectID,'总部',$selectData);
         $selectData = 'SUM(FLEVERAMOUNT)';
        $result[0]['TATOLHASHDSUFLEVERAMOUNT'] = $this->getSUBSCRIBECONFIRMData($projectID,'总部',$selectData);
         $selectData = 'SUM(FAMOUNT+FLEVERAMOUNT)';
        $result[0]['TATOLHASRGSU'] = $this->getSUBSCRIBECONFIRMData($projectID,'区域',$selectData);
        $selectData = 'SUM(FAMOUNT)';
        $result[0]['TATOLHASRGPERSONSU'] = $this->getSUBSCRIBECONFIRMData($projectID,'区域',$selectData);
        $selectData = 'SUM(FLEVERAMOUNT)';
        $result[0]['TATOLHASRGSUFLEVERAMOUNT'] = $this->getSUBSCRIBECONFIRMData($projectID,'区域',$selectData);


        $selectData = 'SUM(FAMOUNT+FLEVERAMOUNT)';
        $result[0]['TATOLHASAMOUNT'] = $this->getSUBSCRIBECONFIRMData($projectID,NULL,$selectData);

        $selectData = 'SUM(FAMOUNT)';
        $result[0]['TATOLHASPERSONAMOUNT'] = $this->getSUBSCRIBECONFIRMData($projectID,NULL,$selectData);


        $selectData = 'SUM(FLEVERAMOUNT)';
        $result[0]['TATOLHASFLEVERAMOUNT'] = $this->getSUBSCRIBECONFIRMData($projectID,NULL,$selectData);

        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data; ;
    }

    public function getSUBSCRIBECONFIRMData($projectID,$FSTATE,$sl) {
        $selectData = $sl.'as TATOLAMOUNT';
         $where = 'T_SUBSCRIBECONFIRMRECORD.FPROJECTID ='.$projectID;
        if($FSTATE != NULL) {
            if($FSTATE == '总部')
                 $this->db->where('T_FOLLOWER.FSTATE','总部');
            else
                $this->db->where('T_FOLLOWER.FSTATE','区域') ;
        }
        $this->db->select(" $selectData");
        $this->db->join('T_FOLLOWER','T_FOLLOWER.FPROJECTID = T_SUBSCRIBECONFIRMRECORD.FPROJECTID AND T_FOLLOWER.FUSERID = T_SUBSCRIBECONFIRMRECORD.FUSERID');
        $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectID);
        $arr=$this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
         if($arr != NULL){
             return $arr[0]['TATOLAMOUNT'];
        } else {
            return 0;
        }
    }
}