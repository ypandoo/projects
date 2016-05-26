<?php

 defined('BASEPATH') or exit('Error!');

 /**
  *
  */
 class Home extends CI_Controller
 {

  public function __construct()
   {
     # code...
     parent::__construct();
     //$this->load->library(array('session','form_validation'));
    // $this->load->helper(array('url'));
     $this->load->model('home_model');
   }

   public function index($page = 'index')
   {
     # code...
    //$this->load->view('loginview');
    $this->load->view('/front/'.$page);
     //$this->load->view('loginview');
   }

   public function login(){
      if($this->session->userdata('username')!=''){
        redirect(base_url('/index.php/home/index'));
      }else{
        $this->load->view('loginview');  
      }
      
   }

   public function logout(){
      $this->session->unset_userdata('username');
      redirect(base_url('home/login'));
   }

 }
