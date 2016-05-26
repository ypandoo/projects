<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class BonusRecord extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('BonusRecord_model');
        $this->load->library('phpexcel');
        $this->load->library('PHPExcel/iofactory');
    }
    
    //获得用户的所有分红记录
    //BonusRecord/getUserBonusRecord
    public function getUserBonusRecord()
    {
        $userId = $this->input->post('uid');
        $result = $this->BonusRecord_model->getUserBonusRecord($userId);
        echo json_encode($result);
    }
    
    /*
     * var:{"data":[{ "subscribeConfigrmRecordId":1,
			    	"bonusTimes":"12",
			    	"bonusAmount":"12",
			    	"bonusyDate":"2014-09-01 09:50:00"}]}
     * URL:BonusRecord/addBonusList
     * ouput:{"success":true,"errorCode":0,"error":0,"data":true}
     * */
    
    public function  addBonusList() {
        $data = $this->input->input_stream();
         
        $result = $this->BonusRecord_model->addBonusList($data['data']);
    	echo json_encode($result);
    }
    /*
     * 
     * 
     * 
     * {"data":[{ "FSUBSCRIBECONFIGRMRECORDID":1,
			    	"FBONUSTIMES":"12333",
			    	"FBONUSAMOUNT":"121120",
			    	"FBONUSDATE":"2014-09-01 09:50:00",
			    	"FID":1}]}
     * URL:BonusRecord/updateBonusList
     * ouput:{"success":true,"errorCode":0,"error":0,"data":true}
     * 
     * */
    public function updateBonus() {
        
        $data = $this->input->input_stream();
        $tableName = 'T_BONUSRECORD';
        $this->load->model('Tools');
        foreach ($data as $item) {
            $result = $this->Tools->updateData($item,$tableName);
        }
        echo json_encode($result);
    }
    // BonusRecord/deleteBonus
    public function deleteBonus() {
        $data = $this->input->input_stream();
        $tableName = 'T_BONUSRECORD';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
    }

//BonusRecord/outputXls
    public function outputXls()
    {
       $projectId = $this->input->post('projectId');
       
       $result = $this->BonusRecord_model->getAllPayRecod($projectId);
      
        
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
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '分红批次');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '分红日期');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '分红金额');
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
            if($data['FCONFIRMAMOUNT'] == null)
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 0);
            else 
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FCONFIRMAMOUNT']);
            $col++;
           
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 1);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, date('y-m-d h:i:s',time()));
            $col++;
            $row++;
        }
        $fileName ="FengHongMuBan-".date('y-m-d-h-i-s',time()).".xls";

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
           $sheetData =   $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
           $row = 0;
           $result = "";
           foreach ($sheetData as $key => $value) {
                if($row == 0)
                {
                    $row ++;
                    continue;
                }
                $insertArr = array();
                $insertArr['FBONUSDATE'] = $value['G'];
                $insertArr['FBONUSAMOUNT'] = $value['H'];
                $count = $this->BonusRecord_model->getBonusCountWithTime($value['A'],$value['F']);
                $tableName = 'T_BONUSRECORD';
                $this->load->model('Tools');
            
                if(intval($count)>0){
                    $where = 'FSUBSCRIBECONFIGRMRECORDID='. $value['A'].' AND FBONUSTIMES='. $value['F'];
                    $result = $this->Tools->updateData( $insertArr,$tableName,$where);
                } else {
                     $insertArr['FSUBSCRIBECONFIGRMRECORDID'] = $value['A'];
                     $insertArr['FBONUSTIMES'] = $value['F'];
                     $result = $this->Tools->addData( $insertArr,$tableName);
                } 
           }
           if($result)
                echo json_decode($result);
         }
       
    }

    //BonusRecord/getBonusRecordListByName

    public function getBonusRecordListByName(){
         $projectId =  $this->input->post('projectId');
         $subscribeStartDate = $this->input->post('startDate');
         $subscribeEndDate = $this->input->post('endDate');
         $userName = $this->input->post('uname');
         $result = $this->BonusRecord_model->getBonusRecordListByName($subscribeStartDate, $subscribeEndDate,$userName,$projectId);
         echo json_encode($result);
    }
    
    // BonusRecord/exportBonusRecordXls
    public function exportBonusRecordXls()
    {
        $projectId =  $this->input->post('projectId');
        $subscribeStartDate = $this->input->post('startDate');
        $subscribeEndDate = $this->input->post('endDate');
        $userName = $this->input->post('uname');
        $result = $this->BonusRecord_model->exportBonusRecordXls($subscribeStartDate, $subscribeEndDate,$userName,$projectId);
       
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
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '分红批次');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '分红日期');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '分红金额');
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
             if($data['FCONFIRMAMOUNT'] == null)
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 0);
            else 
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FCONFIRMAMOUNT']);
            
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FBONUSTIMES']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FBONUSDATE']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FBONUSAMOUNT']);
            $row++;
        }
        $fileName ='FengHongJiLu-'.date('y-m-d-h-i-s',time()).".xlsx";

        $baseURL = site_url();
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("fileFolder/".$fileName);
        $dataR["success"] = true;
        $dataR["errorCode"] = 0;
        $dataR["error"] = 0;
        $dataR['data'] = $fileName;
        echo json_encode($dataR);
    }
    //根据userid把该用户所有的分红信息列出来
    //BonusRecord/getBonusDetail
    public function getBonusDetail() {
        $userId = $this->input->post('uid');
        $result = $this->BonusRecord_model->getBonusDetail($userId);
        echo json_encode($result);
    }
     //BonusRecord/updateBonusRecordWithTotalBonues
    public function updateBonusRecordWithTotalBonues()
    {

        $projectID =  $this->input->post('projectId');
        $time = $this->input->post('time');
        $totalBonus = $this->input->post('totalBonus');
        $result = $this->BonusRecord_model->updateBonusRecordWithTotalBonues($time,$totalBonus,$projectID);
        echo json_encode($result);
    }
}