<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Pic extends CI_Controller
{

    public function __construct()    
    {
        # code...
        parent::__construct();
        $this->load->model('Pic_model');
         $this->load->helper(array('form', 'url'));
    }

    /*
     * 
     * 输入：newsId=123
     *  接口：news/getDynamicNewsDetail
     * 输出：{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}]}
     * */
    public function  getPicListWithProjectID() {
        
        $projectID = $this->input->post('FPROJECTID');
        $result = $this->Pic_model->getPicListWithProjectID($projectID);
        echo json_encode($result);
    }
    // 添加项目图片
     // Pic/addImage
    public function addImage()
    {
         /*$projectID = $this->input->post('projectId');

         $config['upload_path']      = './images/';
         $config['allowed_types']    = 'gif|jpg';
         $config['max_size']     = 100;
         $config['max_width']        = 1024;
         $config['max_height']       = 768;
         $name = $_FILES["file"]["name"];
         $config['file_name']  =  date('y-m-d-h-i-s',time()).iconv("UTF-8","gb2312", $name);
         $this->load->library('upload', $config);
         
         if ( ! $this->upload->do_upload('file'))
         {
             $error = array('error' => $this->upload->display_errors());
         
             $this->load->view('upload_form', $error);
         }
         else
         {
             $data = array('upload_data' => $this->upload->data());
             $filePath = $data['upload_data']['file_name'];
             $insertdata['FPROJECTID'] = $projectID;
             $insertdata['FCONTENT'] = iconv("gb2312","UTF-8", $filePath);
             $insertdata['FISMAINPIC'] = false;
             $insertdata['FNAME'] = iconv("gb2312","UTF-8", $filePath);
             $tableName = 'T_PIC';
             $this->load->model('Tools');
             $result = $this->Tools->addData($insertdata,$tableName);
             $result['data'] = $filePath;
             echo json_encode($result);
         }*/

        $id = $this->input->post('projectId');
        if(!$id)
        {
              $data_result["success"] = 0;
              $data_result["errorCode"] = 0;
              $data_result["error"] = 0;
              $data_result['data'] = "图片上传失败";
            echo json_encode($data_result);
            exit;
        }
      //pic_data
      //save img  
        $ex = explode(",",$this->input->post('pic_data'));//分割data-url数据
        $filter=explode('/', trim($ex[0],';base64'));//获取文件类型
        $ss = base64_decode(str_replace($filter[1] , '', $ex[1]));//图片解码
        $namewithoutpath = md5(uniqid(rand())).'.'.$filter[1];
        $picname =  'images/'.$namewithoutpath;//生成文件名
        $this->base64_to_jpeg($this->input->post('pic_data'), $picname);

        $insertdata['FPROJECTID'] = $id;
        $insertdata['FCONTENT'] = iconv("gb2312","UTF-8", $namewithoutpath);
        $insertdata['FISMAINPIC'] = false;
        $insertdata['FNAME'] = iconv("gb2312","UTF-8", $namewithoutpath);
        $tableName = 'T_PIC';
        $this->load->model('Tools');
        $result = $this->Tools->addData($insertdata,$tableName);
        $result['data'] = $picname;

        echo json_encode($result);
    }
     
     // 更新项目图片
     // Pic/updateImage
     public function updateImage()
     {

      $id = $this->input->post('projectId');
        if(!$id)
        {
              $data_result["success"] = 0;
              $data_result["errorCode"] = 0;
              $data_result["error"] = 0;
              $data_result['data'] = "图片上传失败";
            echo json_encode($data_result);
            exit;
        }
      //pic_data
      //save img  
        $ex = explode(",",$this->input->post('pic_data'));//分割data-url数据
        $filter=explode('/', trim($ex[0],';base64'));//获取文件类型
        $ss = base64_decode(str_replace($filter[1] , '', $ex[1]));//图片解码
        $namewithoutpath = md5(uniqid(rand())).'.'.$filter[1];
        $picname =  'images/'.$namewithoutpath;//生成文件名
        $this->base64_to_jpeg($this->input->post('pic_data'), $picname);
        $insertdata['FCONTENT'] = $namewithoutpath;//md5(uniqid(rand())).'.'.$filter[1];
        $insertdata['FNAME'] = $namewithoutpath;//md5(uniqid(rand())).'.'.$filter[1];
        $tableName = 'T_PIC';
        $where='FPROJECTID='.$id.' AND FISMAINPIC = true';
        $this->load->model('Tools');
        $result = $this->Tools->updateData($insertdata,$tableName,$where);
        $result['data'] = $picname;
             //echo json_encode($result);
        echo json_encode($result);
     }

     protected function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, "wb"); 

        $data = explode(',', $base64_string);

        fwrite($ifp, base64_decode($data[1])); 
        fclose($ifp); 

        return $output_file; 
    }

     public function deleteImage()
     {
        $data = $this->input->input_stream();
        $tableName = 'T_PIC';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
     }
    //获得主图
    //Pic/getMainImage
     public function getMainImage()
     {
        $projectId = $this->input->post('projectId');
        $result = $this->Pic_model->getMainImage($projectId);
        echo json_encode($result);

     }

     //获得所有图片
     //Pic/getAllProjectImage
     public function getAllProjectImage()
     {
         $projectId = $this->input->post('projectId');
        $result = $this->Pic_model->getAllProjectImage($projectId);
        echo json_encode($result);
     }
//删除图片
     //Pic/deletePic
     public function deletePic() {
        $data = $this->input->input_stream();
        $tableName = 'T_PIC';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
    }
}