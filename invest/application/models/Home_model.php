<?php
defined('BASEPATH') or exit('Error');

/**
 *
 */
class Home_model extends CI_Model
{

  public function __construct()
  {
    # code...
    parent::__construct();
    $this->load->database();
  }

  public function deletebook($id){
      $query = $this->db->where('bookID',$id);
      return $this->db->delete('books');
  }
  public function getBooks(){
      $query=$this->db->select('*');
      $query=$this->db->get('books');
      return $query->result_array();

  }
  
  public function  getUseInfo()
  {
     
     $this->load->model('News_model');
     return $this->News_model->getDynamicNewsDetailtest();
  }

  public function getLoginInfo($username,$password){
    $query = $this->db->select("*");
    $query = $this->db->from("users");
    $query = $this->db->where("username",$username);
    $query = $this->db->where("password",$password);
   // return  $this->db->result();
      if($this->db->count_all_results()==1){
        return TRUE;
      }else{
        return FALSE;
      }

  }

  public function getBook_byId($id)
  {
    # code...
    $query = $this->db->where('bookID',$id);
    $query = $this->db->get('books');
    return $query->result_array();
  }

  public function savebookInfo($book,$email){
    $data = array('Tittle'=>$book,'email'=>$email);
    return $this->db->insert('books',$data);
  }
  
}
