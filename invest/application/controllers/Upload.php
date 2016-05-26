<?php

class Upload extends CI_Controller {
    function __construct()
    {
         parent::__construct();

        $this->load->library('phpexcel');
        $this->load->library('PHPExcel/iofactory');
        //$this->load->library(array('session','form_validation'));
      $this->load->helper(array('url','form'));
    }
    public function index()
    {
        $this->load->view('upload_form');
    }
    public function createXls()
    {
       $this->load->database();
       $query = $this->db->query("select * from T_USER");
       if(!$query)
            return false;

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")->setDescription("description");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }

        $row = 2;
        foreach($query->result() as $data)
        {
             $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
            $row++;
        }
        // Assign cell values
       // $objPHPExcel->setActiveSheetIndex(0);
       // $objPHPExcel->getActiveSheet()->setCellValue('A1', 'cell value here');
        //$objPHPExcel->getActiveSheet()->setCellValue('A2', 'cell value here');
        // Save it as an excel 2003 file
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("nameoffile_2.xls");
    }

    public function insertXls()
    {
        $inputFileType = 'Excel5';
        $inputFileName = 'nameoffile_2.xls';
        /**  Create a new Reader of the type defined in $inputFileType  **/
        $objReader = IOFactory::createReader($inputFileType);
            
        $objReader->setReadDataOnly(true);
        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($inputFileName);
        $sheetData =$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        echo json_encode($sheetData);
    }
}