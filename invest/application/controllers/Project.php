<?php


defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Project extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('project_model');
    }

    public function index()
    {
        # code...
        $this->load->view('loginview');
         
    }
    
    public function  getProjectBack()
    {
        $result = $this->project_model->getProjectBack();
        echo  json_encode($result);
    }

    //获得所有项目列表
    // project/getAllProjectList
    public function getAllProjectList()
    {
         $userID = $this->input->post('uid');
        $result = $this->project_model->getAllProjectList($userID);
        echo  json_encode($result);
    }

    //项目统计接口
     //project/getStatisticsInfo
     public function getStatisticsInfo()
     {
        $result = $this->project_model->getStatisticsInfo();
        echo  json_encode($result);
     }
    
    public function updateProjectBack()
    {
        
        $data = $this->input->input_stream();
        $where = 'FID ='.$data['FID'];
        $tableName = 'T_PROJECT';
        $this->load->model('Tools');
        $result = $this->Tools->updateData($data,$tableName,$where);
        echo json_encode($result);
    }
    
    public function deleteProjectBack()
    {
    
        $data = $this->input->input_stream();
        $tableName = 'T_PROJECT';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
    }
    
    public function  updateProjectDetailInfo()
    {
       // $data = $this->input->post('floorArea');
        date_default_timezone_set("Asia/Shanghai");
        $insertArr['FPROJECTID'] =  $this->input->post('projectId');
        $insertArr['FAREA'] = $this->input->post('floorArea');
        $insertArr['FSTRUCTAREA'] = $this->input->post('structArea');
        $insertArr['FRJL'] = $this->input->post('plotArea');
        $insertArr['FSALEAREA'] = $this->input->post('saleStructArea');
        $startdatetime = new DateTime($this->input->post('groundDate'));
        $groundInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FGETDATE'] = $groundInp;
       
        
        $insertArr['FTOTAL'] = $this->input->post('groundAmount');
        $insertArr['FCASHFLOWBACK'] = $this->input->post('returndate');
        $insertArr['FGETWAY'] = $this->input->post('groundType');
        $insertArr['FPOSITION'] = $this->input->post('groundPosition');
        //$insertArr['FPROPOSITION'] = $this->input->post('groundPosition');
        $insertArr['FPROPOSITION'] = $this->input->post('groundPositioning');
        $insertArr['FSCHEME'] = $this->input->post('groundPlanning');
        $insertArr['FPRICE'] = $this->input->post('planFold');
        $insertArr['FCYWYSP'] = $this->input->post('planRent');
        $insertArr['FIRR'] = $this->input->post('planIrr');
        $insertArr['FPREPROFIT'] = $this->input->post('FPREPROFIT');
        $insertArr['FPROFIT'] = $this->input->post('FPROFIT');
        $startdatetime = new DateTime($this->input->post('planStageStartDate'));
        $stageStartInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FSTARTDATE'] = $stageStartInp;
        $startdatetime = new DateTime($this->input->post('planStageOpenDate'));
        $stageOpenInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FOPENDATE'] = $stageOpenInp;
        $startdatetime = new DateTime($this->input->post('planDeliverDate'));
        $deliverInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FHANDDATE'] = $deliverInp;
        $startdatetime = new DateTime($this->input->post('planCarryoverDate'));
        $carryoverInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FCARRYOVERDATE'] = $carryoverInp;
        $startdatetime = new DateTime($this->input->post('planLiquidateDate'));
        $liquidateInp= $startdatetime->format('Y-m-d H:i:s');
        $insertArr['FLIQUIDATE'] = $liquidateInp;
        $insertArr['FPROPERTYSCHEME'] = $this->input->post('planPropertyScheme');
        $insertArr['FPARTNERINFO'] = $this->input->post('corpPartnerBackground');
        $insertArr['FCONTRIBUTIVE'] = $this->input->post('corpContributiveRatio');
        $insertArr['FANSWERMAIL'] = $this->input->post('restAnswerMail');
        $insertArr['FPROJECTINFOMANAGERS'] = $this->input->post('restProjectManagers');
        $insertArr['FFOLLOWERMANAGERS'] = $this->input->post('restFollowerManagers');
        $dataProjectname['FNAME'] =  $this->input->post('projectName');
        $dataProjectname['FID'] = $this->input->post('projectId');
        $where='FID='.$dataProjectname['FID'];
        $tableName = 'T_PROJECT';
        $this->load->model('Tools');
        $result = $this->Tools->updateData($dataProjectname,$tableName,$where);
       
            $tableName = 'T_PROJECTDETAILINFO';
            $where = 'FPROJECTID='.$insertArr['FPROJECTID'];
            $result = $this->Tools->updateData($insertArr,$tableName,$where);
       
        header('Location:'.$this->input->post('url'));
        //header($this->input->post('url'));
    }
    
    /*
     * 
     * begin=0&count=2&uid=test1&subscribeStartDate='2014-09-01 09:50:00'&subscribeEndDate='2014-09-01 09:50:00'&status=1
     * project/getProjectList
     * 
     * {"success":true,"errorCode":0,"error":0,"data":[{"projectName":"123","projectId":"123","HDAmount":3,"regioAmount":3,"HDAmountComplete":"test","regioAmountComplete":"test","picList":[]}]
     * 
     * */

    
     public function  getProjectList()
     {
         
         $begin = $this->input->post('begin');
         $count = $this->input->post('count');
         $userID = $this->input->post('uid');
         $subscribeStartDate = $this->input->post('subscribeStartDate');
         $subscribeEndDate = $this->input->post('subscribeEndDate');
         $status = $this->input->post('status');
         $projectName = $this->input->post('searchname');
         $result = $this->project_model->getProjectList($begin,$count,$userID,$subscribeStartDate, $subscribeEndDate, $status,$projectName);
         echo  json_encode($result);
     }


     /*

        获得所有可以跟投的项目名单

        project/getAllFollowProject
     */
     public function getAllFollowProject()
     {
         $userID = $this->input->post('uid');
         $subscribeStartDate = $this->input->post('subscribeStartDate');
         $subscribeEndDate = $this->input->post('subscribeEndDate');
         $projectName = $this->input->post('searchname');
         $queryType = $this->input->post('queryType');
         $result = $this->project_model->getAllFollowProject($userID,$subscribeStartDate, $subscribeEndDate,$projectName,$queryType);
         echo  json_encode($result);
     }


      /*

        获得所有可以跟投的项目名单

        project/getUserAllFollowProject
     */
     public function getUserAllFollowProject()
     {
         $userID = $this->input->post('uid');
         $subscribeStartDate = $this->input->post('subscribeStartDate');
         $subscribeEndDate = $this->input->post('subscribeEndDate');
         $projectName = $this->input->post('searchname');
         $queryType = $this->input->post('queryType');
         $result = $this->project_model->getUserAllFollowProject($userID,$subscribeStartDate, $subscribeEndDate,$projectName,$queryType);
         echo  json_encode($result);
     }
     
     /*
      * projectId=1
      * project/getProjectDetail
      * {"FID":"1","FPROJECTID":"1","FAREA":"12","FSTRUCTAREA":"113","FRJL":"12","FSALEAREA":"12","FGETDATE":"2014-09-02","FTOTAL":"123","FGETWAY":"test","FPOSITION":"\u5408\u80a5\u9ad8\u65b0KD4-2","FPROPOSITION":"\u653f\u52a1\u533a","FSCHEME":"\u653f\u52a1\u533a","FPRICE":"23","FCYWYSP":"34","FIRR":"21","FPREPROFIT":"12342","FPROFIT":"112","FSTARTDATE":"2014-09-02","FOPENDATE":"2014-09-02","FCASHFLOWBACK":"asdfa","FHANDDATE":"2014-09-04","FCARRYOVERDATE":"2014-09-02","FLIQUIDATE":"2014-09-02","FPROPERTYSCHEME":"safsaf","FPARTNERINFO":"asdfsadf","FCONTRIBUTIVE":"23","FANSWERMAIL":"23","FFOLLOWERMANAGERS":"sadf","FPROJECTINFOMANAGERS":"sadf","PictureList":[{"FID":"1","FPROJECTID":"1","FNAME":"\u5408\u80a5\u9ad8\u65b0","FCONTENT":"123","FISMAINPIC":"1"}],"NEWSList":[{"FID":"124","FPROJECTID":"1","FTITLE":"\u5408\u80a5\u9ad8\u65b0","FCREATORID":"123","FRELEASEDATE":"2016-01-17 08:58:47","FCONTENT":"\u5408\u80a5\u9ad8\u65b0\u9879\u76ee\u5bf9\u8d26\u516c\u793a-1 - \u5185\u5bb9"}],"FollowerList":[{"FID":"124","FPROJECTID":"1","FUSERID":"1","FSEQ":"zdf","FSTATE":"sadfs","FTYPE":"saf","FDUTY":"gaoguan","FTOPLIMIT":"2","FDOWNLIMT":"3","FREMARK":"asff"}],"FollowSchemeList":[{"FID":"1","FPROJECTID":"1","FCREATORID":"1","FNAME":"\u534f\u8bae","FDETAIL":"sadfs","FCREATETIME":"2016-01-17 08:53:51"}]}
      * */
     public function  getProjectDetail()
     {
          
         $projectId = $this->input->post('projectId');
         $fields = $this->input->post('fields');
         $result = $this->project_model->getProjectDetailInfo($projectId,$fields);
         echo  json_encode($result);
     }
     /*
      * {'FNAME':'FNAME','FSTATE':'FSTATE'}
      * Project/addProject
      * {"success":true,"errorCode":0,"error":0,"data":"0"}
      * */
     public function  addProject()
     {
         
        $data = $this->input->input_stream();
        $tableName = 'T_PROJECT';
        $this->load->model('Tools');
        $result = $this->Tools->addData($data,$tableName);
        $projectDetail['FPROJECTID'] = $result['data'];
        $tableName = 'T_PROJECTDETAILINFO';
        $result = $this->Tools->addData($projectDetail,$tableName);
        $tableName = 'T_FOLLOWSCHEME';
        $result = $this->Tools->addData($projectDetail,$tableName);
        $tableName = 'T_PIC';
        $PICData['FPROJECTID']=$projectDetail['FPROJECTID'];
        $PICData['FNAME']='default.jpg';
        $PICData['FCONTENT']='default.jpg';
        $PICData['FISMAINPIC']=true;
        $result = $this->Tools->addData($PICData,$tableName);
        echo json_encode($result);
     }
     
     public function  deleteEnclosure(){
         $FID = $this->input->post('FID');
         $data = $this->input->input_stream();
         $tableName = 'T_FOLLOWSCHEME';
         $this->load->model('Tools');
         $where='FID='.$FID;
         $result = $this->Tools->updateData($data,$tableName,$where);
         echo json_encode($result);
     }
     
     public function  addEnclosure() {
         $FID = $this->input->post('uploadSchemeId');
         $config['upload_path']      = './fileFolder/';
         $config['allowed_types']    = 'gif|jpg|png|txt|xls|doc|docx';
         $config['max_size']     = 100;
         $config['max_width']        = 1024;
         $config['max_height']       = 768;
         $name = $_FILES["file"]["name"];
         $this->load->model('FollowScheme_model');
         
         $followScheme = $this->FollowScheme_model->getPersonBankInfo($FID);
         $is_exist = is_int(strpos($followScheme['FLINK'],$name));
         if ($is_exist){
             echo "update fail";
             return ;
         }
         if($followScheme['FLINK']){
             $followScheme['FLINK'] = $followScheme['FLINK'].';'.$name;
         } else {
             $followScheme['FLINK'] = $name;
         }
         $config['file_name']  =  iconv("UTF-8","gb2312", $name);
         $this->load->library('upload', $config);
         
         if ( ! $this->upload->do_upload('file'))
         {
             $error = array('error' => $this->upload->display_errors());
         
             $this->load->view('upload_form', $error);
         }
         else
         {
             $data = array('upload_data' => $this->upload->data());
             $filePath =  './fileFolder/'.$data['upload_data']['file_name'];
             $insertdata['EnclosurePath'] = iconv("gb2312","UTF-8", $filePath);
             $tableName = 'T_FOLLOWSCHEME';
             $where='FID='.$FID;
             $this->load->model('Tools');
             $result = $this->Tools->updateData($followScheme,$tableName,$where);
             //echo json_encode($result);
         }
         header('Location:'.$this->input->post('url'));
        
     }
     
     public function  getProjectFollowUserList()
     {
         $projectID = $this->input->post('projectId');
         $this->load->model('ProjectUser_model');
         $result = $this->ProjectUser_model->getFollowerList($projectID);
         echo json_encode($result);
     }

     public function getAllFollowProjectWithUserID()
     {
         $userID = $this->input->post('uid');
     
         $result = $this->project_model->getAllFollowProjectWithUserID($userID);
         echo json_encode($result);
     }
}
