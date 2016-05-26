<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Payrecord extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('Payrecord_model');
        $this->load->library('phpexcel');
        $this->load->library('PHPExcel/iofactory');
    }

    //获得用户的所有交款记录
    public function getUserPayRecord()
    {
        $userId = $this->input->post('uid');
        $result = $this->BonusRecord_model->getUserPayRecord($userId);
        echo json_encode($result);
    }

/*
 * begin=0&count=2&uid=test1&projectId=123
 * playRecode/getPersonalDetail
 * {"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FSUBSCRIBECONFIGRMRECORDID":"123","FPAYTIMES":"1","FPAYDATE":"2014-09-01","FPAYAMOUNT":"3","FLEVERAMOUNT":"2014-09-01 09:53:00","FPROJECTNAME":"test","FPROJECTID":"123","FUSERID":"test1"}],"totalPayAmount":3}
 * */
    public function  getPersonPayDetail()
    {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');;
        $result = $this->Payrecord_model->getPersonPayDetail($begin,$count,$userID,$projectId);
        echo json_encode($result);
        
    }
    
    public function getPersonSubscribeDetail() {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');
        $result = $this->User_model->getPersonSubscribeDetail($begin,$count,$userID,$projectId);
        echo 3;
    }
    /*
     * 
     * 参数：{"data":[{ "subscribeConfigrmRecordId":"123",
			    	"payTimes":"12",
			    	"payAmount":"12",
			    	"payDate":"2014-09-01 09:50:00"}]}
     * 接口：payrecord/addpayList
     * 输出：{"success":true,"errorCode":0,"error":0,"data":true}
     * */
    public function  addpayList() {
        $data = $this->input->input_stream();
        $result = $this->Payrecord_model->addpayList($data['data']);
        echo json_encode($result);
    }
    
     public function deletePayrecord() {
        $data = $this->input->input_stream();
        $tableName = 'T_PAYRECORD';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
    }

    public function outputXls()
    {
       $projectId = $this->input->post('projectId');
       $result = $this->Payrecord_model->getAllPayRecod($projectId);
       $query = $this->db->query("select * from T_USER");
       if(!$query)
            return false;

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")->setDescription("description");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $fields = $this->Payrecord_model->getAllPayRecodFilds($projectId);;
        $col = 0;
       
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款人唯一标示(勿动)');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '跟投人');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '部门');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '总部/区域');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '认购金额');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款批次');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款日期');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款金额');
            $col++;
        

        $row = 2;
       // echo json_encode($result);
        foreach($result as $data)
        {
            $col = 0;  
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FID']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FNAME']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FORG']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FSTATE']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FCONFIRMAMOUNT']);
            $col++;
           
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 1);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, date('y-m-d h:i:s',time()));
            $col++;
            $row++;
        }
        $fileName ="JiaoKuanMuBan-".date('y-m-d-h-i-s',time()).".xls";

        $baseURL = site_url();
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("fileFolder/".$fileName);
        $dataR["success"] = true;
        $dataR["errorCode"] = 0;
        $dataR["error"] = 0;
        $dataR['data'] = $fileName;
        echo json_encode($dataR);
    }

    public function inputXLS()
    {
         $FID = $this->input->post('uploadSchemeId');
         $config['upload_path']      = './fileFolder/';
         $config['allowed_types']    = 'gif|jpg|png|txt|xls|doc';
         $config['max_size']     = 100;
         $config['max_width']        = 1024;
         $config['max_height']       = 768;
         $name = $_FILES["file"]["name"];
    
         $config['file_name']  =  iconv("UTF-8","gb2312", $name);
         $this->load->library('upload', $config);
         if ( ! $this->upload->do_upload('file'))
         {
             $error = array('error' => $this->upload->display_errors());
         
             //$this->load->view('upload_form', $error);
         }
         else
         {
            $data = array('upload_data' => $this->upload->data());
            $filePath =  './fileFolder/'.$data['upload_data']['file_name'];
            $insertdata['EnclosurePath'] = iconv("gb2312","UTF-8", $filePath);
             
             
            $inputFileType = 'Excel5';
            $inputFileName = $filePath;
        
            $objReader = IOFactory::createReader($inputFileType);
            
            $objReader->setReadDataOnly(true);
           /**  Load $inputFileName to a PHPExcel Object  **/
           $objPHPExcel = $objReader->load($inputFileName);
           $sheetData =$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
           $row = 0;
           $result = "";
           foreach ($sheetData as $key => $value) {
                if($row == 0)
                {
                    $row ++;
                    continue;
                }
                $insertArr = array();
                $insertArr['FPAYDATE'] = $value['G'];
                $insertArr['FPAYAMOUNT'] = $value['H'];
                $count = $this->Payrecord_model->getPayCountWithTime($value['A'],$value['F']);
                $tableName = 'T_PAYRECORD';
                $this->load->model('Tools');
            
                if(intval($count)>0){
                    $where = 'FSUBSCRIBECONFIGRMRECORDID='. $value['A'].' AND FPAYTIMES='. $value['F'];
                    $result = $this->Tools->updateData( $insertArr,$tableName,$where);
                } else {
                     $insertArr['FSUBSCRIBECONFIGRMRECORDID'] = $value['A'];
                     $insertArr['FPAYTIMES'] = $value['F'];
                     $result = $this->Tools->addData( $insertArr,$tableName);
                } 
           }
           if($result)
                echo json_decode($result);
         }
       
    }

    //Payrecord/getPayRecoListByName

    public function getPayRecordListByName(){
         $projectId =  $this->input->post('projectId');
         $subscribeStartDate = $this->input->post('startDate');
         $subscribeEndDate = $this->input->post('endDate');
         $userName = $this->input->post('uname');
         $result = $this->Payrecord_model->getPayRecordListByName($subscribeStartDate, $subscribeEndDate,$userName,$projectId);
         echo json_encode($result);
    }
    
    // Payrecord/exportPayRecordXls
    public function exportPayRecordXls()
    {

        $projectId =  $this->input->post('projectId');
        $subscribeStartDate = $this->input->post('startDate');
        $subscribeEndDate = $this->input->post('endDate');
        $userName = $this->input->post('uname');
        
       $result = $this->Payrecord_model->exportPayRecordXls($subscribeStartDate, $subscribeEndDate,$userName,$projectId);
       
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")->setDescription("description");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
       
        $col = 0;
       
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款人唯一标示(勿动)');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '跟投人');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '部门');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '总部/区域');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '认购金额');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款批次');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款日期');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款金额');
            $col++;
        

        $row = 2;
       // echo json_encode($result);
        foreach($result as $data)
        {
            $col = 0;  
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FID']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FNAME']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FORG']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FSTATE']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FCONFIRMAMOUNT']);
            
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FPAYTIMES']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FPAYDATE']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FPAYAMOUNT']);
            $row++;
        }
        $fileName ="JiaoKuanJiLu-".date('y-m-d-h-i-s',time()).".xls";

        $baseURL = site_url();
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("fileFolder/".$fileName);
        $dataR["success"] = true;
        $dataR["errorCode"] = 0;
        $dataR["error"] = 0;
        $dataR['data'] = $fileName;
        echo json_encode($dataR);
    }
 //Payrecord/testSum
    public function testSum() {
         $result = $this->Payrecord_model->testSum();
        echo json_encode($result);
    }

    //根据userid把该用户所有的缴款列出来
   //Payrecord/getPayInDetail
    public function getPayInDetail()
    {

       
         $userId = $this->input->post('uid');
        $result = $this->Payrecord_model->getPayInDetail($userId);
        echo json_encode($result);
    }
}