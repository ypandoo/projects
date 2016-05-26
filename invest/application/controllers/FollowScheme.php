<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class FollowScheme extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('FollowScheme_model');
    }

    /*
     * 
     * 输入：FPROJECTID=1
     *  接口：FollowScheme/getFollowShemeListWithProjectID
     * 输出：{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}]}
     * */
    public function  getFollowShemeListWithProjectID() {
        
        $projectID = $this->input->post('projectId');
        $result = $this->FollowScheme_model->getFollowerSchemeListWithProjectID($projectID);
        echo json_encode($result);
    }
     
    public function updateFollowScheme() {
    
        $tableName = 'T_FOLLOWSCHEME';
        $this->load->model('Tools');
        date_default_timezone_set("Asia/Shanghai");
        $FID = $this->input->post('schemeId');
        $insertArr['FPROJECTID'] =  $this->input->post('projectId');
        
        $insertArr['FFUNDPEAKE'] = $this->input->post('fundPeake');
        $insertArr['FFOLLOWTEAM'] = $this->input->post('followAmountDesc');
        $insertArr['FHDRATIO'] = $this->input->post('groupForceRatio');
        $insertArr['FREGIONRATIO'] = $this->input->post('compForceRatio');
        
        $startdatetime = new DateTime($this->input->post('subscribeStartDate'));
        $subscribeStartInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FSUBSCRIBESTARTDATE'] = $subscribeStartInp;
        
        $insertArr['FREGIONAMOUNT'] = $this->input->post('compForceAmount');
         $insertArr['FHDAMOUNT'] = $this->input->post('groupForceAmount');
        $insertArr['FALLRATION'] = $this->input->post('compChoiceRatio');
        $insertArr['FALLAMOUNT'] = $this->input->post('compChoiceAmount');
        $insertArr['FLEVERAGEDES'] = $this->input->post('leverageDes');
        
        $insertArr['FCOLLECTWAY'] = $this->input->post('subscribeRemind');
        
        $startdatetime = new DateTime($this->input->post('subscribeEndDate'));
        $subscribeEndtInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FSUBSCRIBEENDDATE'] = $subscribeEndtInp;
        
        $startdatetime = new DateTime($this->input->post('payStartDate'));
        $subscribeStartInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FPAYSTARTDATE'] = $subscribeStartInp;
        
        $startdatetime = new DateTime($this->input->post('payEndDate'));
        $payEndInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FPAYENDDATE'] =$payEndInp;
        $where='FID='.$FID;
        $result = $this->Tools->updateData($insertArr,$tableName,$where);

        header('Location:'.$this->input->post('url'));
        //echo json_encode($result);
    }
    
    public function deleteFollowerScheme() {
        $data = $this->input->input_stream();
        $tableName = 'T_FOLLOWAGREEMENT';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
    }
    
    public function  addFollowerScheme()
    {
        $data = $this->input->input_stream();
        $tableName = 'T_FOLLOWAGREEMENT';
        $this->load->model('Tools');
        $result = $this->Tools->addData($data,$tableName);
        echo json_encode($result);
    }

}