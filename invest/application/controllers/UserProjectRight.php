<?php  
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class UserProjectRight extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('UserProjectRight_model');
    }

    // 获得指定项目的所有用户权限链表
    //UserProjectRight/getProjectUserRightWithProjectID
    public function getProjectUserRightWithProjectID() {
        $ProjctID =$this->input->post('projectId');
        $result = $this->UserProjectRight_model->getProjectUserRightWithProjectID($ProjctID);
        echo  json_encode($result);
    }

    //获得指定用户指定项目权限
    //UserProjectRight/getUserProjectRight
    public function getUserProjectRight() {
        $ProjctID =$this->input->post('projectId');
        $userID =$this->input->post('uid');
        $result = $this->UserProjectRight_model->getUserProjectRight($userID,$ProjctID);
        echo  json_encode($result);
    }

    //获得指定用户的所有相关的项目权限链表
    //UserProjectRight/getProjectUserRightWithUserID
    public function getProjectUserRightWithUserID() {
        $userID =$this->input->post('uid');
        $result = $this->UserProjectRight_model->getProjectUserRightWithUserID($userID);
        echo  json_encode($result);
    }

    //获得所有用户的项目权限链表
    //UserProjectRight/getAllUserRight
    public function getAllUserRight()
    {
        $ProjctID =$this->input->post('projectId');
        $userName =$this->input->post('uname');
        $result = $this->UserProjectRight_model->getAllUserRight($ProjctID,$userName);
        echo  json_encode($result);
    }


    //编辑用户权限
   // UserProjectRight/editUserProjectRight
    public function editUserProjectRight()
    {
    
        $projectId = $this->input->post('projectId');

        $deletestr = $this->input->post('delUserId');
        $deleteArr = array();
        $arr = explode(",",$deletestr);
        foreach($arr as $u){
            $strarr = explode(":",$u);
            if($strarr[0] != NULL) {
                $deleteArr[$strarr[0]] = $strarr[1];
            }
        }
       // echo json_encode($deleteArr);
        
        foreach ($deleteArr as $key => $value) {
            echo "test delete";
            $where =  'FUSERID ='.$key.' AND FPROJECTID ='.$projectId;
            $tableName = 'T_USERPROJECTRIGHT';
            $this->load->model('Tools');
            $result = $this->Tools->deleteDataWithWhere($tableName,$where);
            
        }

        $addstr = $this->input->post('addUserId');
        $addArr1 = array();
        $arr = explode(",",$addstr);
        foreach($arr as $u){
            $strarr = explode(":",$u);
            if($strarr[0] != NULL) {
                $addArr1[$strarr[0]] = $strarr[1];
            }
            
        }
        //echo json_encode($addArr);

        foreach ($addArr1 as $key => $value) {
           $tmpstr = $value;
            $area = array();      
            for($i = 0;$i < strlen($tmpstr);$i++){
               array_push($area,$tmpstr[$i]);
            }
            $addArr =  array(
                'FUSERID' => $key,
                'FPROJECTID'=>$projectId,
                'FBASICS'=>$area[0],
                'FNEWS'=>$area[1],
                'FSUBSCRIPTION'=>$area[2],
                'FPAYCONFIRM'=>$area[3],
                'FBONUSDETAIL'=>$area[4],
                );
            
            $tableName = 'T_USERPROJECTRIGHT';
            $this->load->model('Tools');
            $result = $this->Tools->addData($addArr,$tableName);
            
        }
        $updatestr = $this->input->post('updUserId');
        $updateArr1 = array();
        $arr = explode(",",$updatestr);
        foreach($arr as $u){
            $strarr = explode(":",$u);
            if($strarr[0] != NULL) {
                $updateArr1[$strarr[0]] = $strarr[1];
            }
          
        }
        //echo json_encode($updateArr);
         foreach ($updateArr1 as $key => $value) {
            $tmpstr = $value;

            $area = array();      
            for($i = 0;$i < strlen($tmpstr);$i++){
               array_push($area,$tmpstr[$i]);
            }
            
            $updatetArr =  array(
                'FUSERID' => $key,
                'FPROJECTID'=>$projectId,
                'FBASICS'=>$area[0],
                'FNEWS'=>$area[1],
                'FSUBSCRIPTION'=>$area[2],
                'FPAYCONFIRM'=>$area[3],
                'FBONUSDETAIL'=>$area[4],
                );
            $where =  'FUSERID ='.$key.' AND FPROJECTID ='.$projectId;
            $tableName = 'T_USERPROJECTRIGHT';
            $this->load->model('Tools');
            $result = $this->Tools->updateData($updatetArr,$tableName,$where);
             //echo json_encode($result);
        }
        $data_result["success"] = true;
        $data_result["errorCode"] = 0;
        $data_result["error"] = 0;
        $data_result['data'] = '';
        echo json_encode($data_result);
    }

   //删除一个管理员
   // UserProjectRight/deleteUserProjectRight
    public function deleteUserProjectRight() {
        $data = $this->input->input_stream();
        $tableName = 'T_USERPROJECTRIGHT';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        return $result;
    }

    // 删除一个管理员
    //UserProjectRight/deleteRelateByUserProject

    public function deleteRelateByUserProject() {
        $ProjctID =$this->input->post('projectId');
        $userID =$this->input->post('uid');
        $where = 'FPROJECTID='.$ProjctID.' AND FUSERID = '.$userID;
        $tableName = 'T_USERPROJECTRIGHT';
        $this->load->model('Tools');
        $result = $this->Tools->deleteDataWithWhere($tableName,$where);
        echo json_encode($result);
    }

    //更新一个管理员
   // UserProjectRight/updateUserProjectRight
    public function updateUserProjectRight() {
    
        
        $data = $this->input->input_stream();
        $where = 'FID='.$data['FID'];
        $tableName = 'T_USERPROJECTRIGHT';
        $this->load->model('Tools');
        $result = $this->Tools->updateData($data,$tableName,$where);
        return $result;
    }
    
    //添加一个管理员
   // UserProjectRight/addUserProjectRight
    public function addUserProjectRight() {
        $data = $this->input->input_stream();
        $tableName = 'T_USERPROJECTRIGHT';
        $this->load->model('Tools');
        $result = $this->Tools->addData($data,$tableName);
        return $result;
    }
}