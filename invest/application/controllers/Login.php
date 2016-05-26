<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Shanghai');


class Login extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }
	public function index()
	{
		//header("Location:".base_url());
		//exit;

		$usercode = $this->input->get('usercode');
		$username = $this->input->get('username');
		$sec = $this->input->get('sec');
		
		//if($sec == $usercode){
			$query = $this->db->query("SELECT * FROM px_managers WHERE usercode = '".$usercode."'");
			$res = $query->row_array();
			$admin_type = $res['type'] > 0 ? $res['type'] : 0;

			$query = $this->db->query("SELECT * FROM px_tmp WHERE usercode = '".$usercode."'");
			$res = $query->row_array();
			$username = $res['username'];
			
			if($username){
				$auth = array(
					'usercode' => $usercode,
					'admin_type' => $admin_type,
					'username' => $username,
				);

				$this->load->model('Mystring_model','MyString');
				$authcode = $this->MyString->authcode(serialize($auth),'ENCODE');

				$this->input->set_cookie('px_auth',$authcode,-3600);

				header("location:".base_url() . 'manage' );
				exit;
			}else die("Invialid Usercode!");
			if($admin_type > 0)
				header("location:".base_url() . 'manage' );
			else
				header("location:".base_url() );
		//}else die("Invalid request!");
	}
    //Login/login
    public function login()
    {



		$this->config->set_item('sess_expiration', 3600*15);//秒
	
		//$this->loginWithLocal();
		$this->loginWithAD();

    }

    public function loginWithAD()
    {
    	$usercode = $this->input->post('username');
		$password = $this->input->post('password');
		$result = $this->User_model->checkLogin($usercode, $password);
		$error = 1 ;
		$successState = true;
		$message = 'success';
		
		$userData = $result['data'][0];
		$this->session->set_userdata('username', $userData['FNAME']);
		$this->session->set_userdata('uid', $userData['FID']);

		$this->session->set_userdata('allow',$userData['FUSERRIGHT']);	
		if($usercode == 'admin')	
		{
			if( $password == $userData['FPASSWORD']) {
				$this->session->set_userdata('allow','1');	
				echo json_encode(array('error'=>$error,'data'=>$message,'errorCode'=>0,'success'=>$successState));
			} else {
				echo json_encode(array('error'=>0,'data'=>$message,'errorCode'=>0,'success'=>false));
			}
			exit;
		}
		
		
		if($usercode && $password){
			$host = "192.168.5.3";  
//			$user = "ldapuser"; 
//			$pswd = "CIFILdapuserRead"; 
			$ad = ldap_connect($host) or die( "Could not connect!" ); 
			//echo('after：'.$after.$host.$ad);
			//exit;
			//var_dump($ad);
			if($ad){ 
				//设置参数 
				ldap_set_option ( $ad, LDAP_OPT_PROTOCOL_VERSION, 3 ); 
				ldap_set_option ( $ad, LDAP_OPT_REFERRALS, 0 ); // bool ldap_bind ( resource $link_identifier [, string $bind_rdn = NULL [, string $bind_password = NULL ]] ) 
				$bd = ldap_bind($ad, $usercode . '@zldcgroup.com', $password); 
				//$bd = 1;
				if($bd){
					$result = $this->User_model->checkLogin($usercode, $password);
					if($result['success'] == true) {
							$userData = $result['data'][0];
							$this->session->set_userdata('username', $userData['FNAME']);
							$this->session->set_userdata('uid', $userData['FID']);

							$this->session->set_userdata('allow',$userData['FUSERRIGHT']);	
							if($usercode == 'admin' && $password == $userData['FPASSWORD'])	
							{

								$this->session->set_userdata('allow','1');	
							}
					} else{
						$message = "验证失败，请确认用户编号和密码是否正确。.";
						$error = 0;
						$successState = false;
					}
				}else{
					$message = "验证失败，请确认用户编号和密码是否正确。";
					$error = 0;
					$successState = false;
				}
			}
		}
		else {
			$message = "请输入用户编号和用户密码";
		}
		
		echo json_encode(array('error'=>$error,'data'=>$message,'errorCode'=>0,'success'=>$successState));
    }

    public function loginWithLocal()
    {
    	$username = $this->input->post('username');
		$password = $this->input->post('password');
		$error = 1 ;
		$successState = true;
		$message = 'success';
		$result = $this->User_model->checkLogin($username, $password);
		if($result['success'] == true) {
			$userData = $result['data'][0];
			$this->session->set_userdata('username', $userData['FNAME']);
			$this->session->set_userdata('uid', $userData['FID']);

			$this->session->set_userdata('allow',$userData['FUSERRIGHT']);	
			if($username == 'admin')	
			{
			    if( $password == $userData['FPASSWORD']) {
			        $this->session->set_userdata('allow','1');
			        echo json_encode(array('error'=>$error,'data'=>$message,'errorCode'=>0,'success'=>$successState));
			    } else {
			        echo json_encode(array('error'=>0,'data'=>$message,'errorCode'=>0,'success'=>false));
			    }
			    exit;
			}
		}
		
		
		
		echo json_encode($result);
    }

	public function userlogin(){
//		error_reporting(E_ALL);
		$usercode = $this->input->post('username');
		$password = $this->input->post('password');
		$error = 1 ;
		if($usercode && $password){
			$host = "192.168.8.232"; 
//			$user = "ldapuser"; 
//			$pswd = "CIFILdapuserRead"; 
			$ad = ldap_connect($host) or die( "Could not connect!" ); 
//			var_dump($ad);
			if($ad){ 
				//设置参数 
				ldap_set_option ( $ad, LDAP_OPT_PROTOCOL_VERSION, 3 ); 
				ldap_set_option ( $ad, LDAP_OPT_REFERRALS, 0 ); // bool ldap_bind ( resource $link_identifier [, string $bind_rdn = NULL [, string $bind_password = NULL ]] ) 
				$bd = ldap_bind($ad, $usercode . '@cifi.com.cn', $password); 
				//$bd = 1;
				if($bd){
					$query = $this->db->query("SELECT * FROM px_managers WHERE usercode = '".$usercode."'");
					$res = $query->row_array();
					$admin_type = $res['type'] > 0 ? $res['type'] : 0;
					$query = $this->db->query("SELECT * FROM px_tmp WHERE usercode = '".$usercode."'");
					$res = $query->row_array();
					$username = $res['username'];
					if($username){
						$auth = array(
							'usercode' => $usercode,
							'admin_type' => $admin_type,
							'username' => $username,
						);
						$this->load->model('Mystring_model','MyString');
						$authcode = $this->MyString->authcode(serialize($auth),'ENCODE');
						$this->input->set_cookie('px_auth',$authcode,-3600);
						$error = 0;
					}else{
						$message = "验证失败，请确认用户编号和密码是否正确。.";
					}
				}else{
					$message = "验证失败，请确认用户编号和密码是否正确。";
				}
			}
		}
		else {
			$message = "请输入用户编号和用户密码";
		}
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
        header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
        header("Cache-Control: no-cache, must-revalidate" ); 
        header("Pragma: no-cache" );
        header("Content-type: text/x-json; charset=utf-8");
		echo json_encode(array('error'=>$error,'message'=>$message));
	}

//login/logout
	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('uid');
		$this->session->unset_userdata('allow');	
		$data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = true;
        echo json_encode($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */