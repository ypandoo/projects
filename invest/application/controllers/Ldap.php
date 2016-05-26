<?php 
defined('BASEPATH') or exit('Error!');
class Ldap extends CI_Controller {
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
        $this->load->helper(array('form', 'url'));
        $this->load->model('Tools');
         $this->load->database();
    }
	public function ldap()
	{
		set_time_limit(0);
		//$this->db->query("truncate px_tmp");
		$host = "192.168.5.3"; 
		$user = "zldcgroup\zldc"; 
		$pswd = "zldc@8888"; 
		$cookie = '';
    	$result = [];
   	 $result['count'] = 0;
    do {
		$ad = ldap_connect($host) or die( "Could not connect!" ); 
		//var_dump($ad);
		if($ad){ 
			//璁剧疆鍙傛暟 
			ldap_set_option ( $ad, LDAP_OPT_PROTOCOL_VERSION, 3 ); 
			ldap_set_option ( $ad, LDAP_OPT_REFERRALS, 0 ); // bool ldap_bind ( resource $link_identifier [, string $bind_rdn = NULL [, string $bind_password = NULL ]] ) 
			$bd = ldap_bind($ad, $user, $pswd) or die ("Could not bind"); 
			ldap_control_paged_result($ad, 500, true, $cookie);
			$attrs = array("displayname","name","sAMAccountName","userPrincipalName","objectclass"); //鎸囧畾闇�鏌ヨ鐨勭敤鎴疯寖鍥� 
			$filter = "(objectclass=*)"; //ldap_search ( resource $link_identifier , string $base_dn , string $filter [, array $attributes [, int $attrsonly [, int $sizelimit [, int $timelimit [, int $deref ]]]]] ) 
			$search = ldap_search($ad, 'ou=中梁集团,DC=zldcgroup,DC=com', $filter, $attrs,0,0,0) or die ("ldap search failed"); 
			$entries = ldap_get_entries($ad, $search); 

			ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
       
      
       

        $result = array_merge($result, $entries);

        ldap_control_paged_result_response($ad, $search, $cookie);
			//echo json_encode($entries);
		//		var_dump($entries);

			$data = array();
			if ($entries["count"] > 0) { 
				//echo '返回记录数：'.$entries["count"]; 
				for ($i=0; $i<$entries["count"]; $i++) { //所要获取的字段，都必须小写 
					//if(isset($entries[$i]["displayname"])){ 
//						echo "<p>name: ".$entries[$i]["name"][0]."<br />";//用户名 
//						echo "<p>sAMAccountName: ".@$entries[$i]["samaccountname"][0]."<br />";//用户名 
						if(isset($entries[$i]["dn"][0])){ 
//							echo "dn: ".$entries[$i]["dn"]."<br />";//用户名字 
							$is_user = in_array('user',$entries[$i]["objectclass"]) ? 1:0; 
							if($is_user == 0) continue;
							$dn = $entries[$i]["dn"];
							$dn = explode(",",$dn);
							
							$area = array();
							foreach($dn as $v){
								if(strpos($v,'OU=') !== false){
									 array_push($area, str_replace("OU=","",$v));//有的抬头不是OU
								} else if(strpos($v,'CN=') !== false){
									array_push($area, str_replace("CN=","",$v));//有的抬头不是CN
								} else if(strpos($v,'DC=') !== false){
									array_push($area, str_replace("DC=","",$v));//有的抬头不是DC
								}
							}

							$area = array_reverse($area);
							$insertArr = array();
							$flag = 1;
							if(is_array($area))
							{
								$flag = count($area,COUNT_NORMAL);
							} 
//							var_dump($area);
						//	list($f6,$f5,$f4,$f3,$f2,$f1) = $area;
							foreach ($area as $val) {
								$keyStr = 'F'.$flag;
								$flag --;
								$insertArr[$keyStr ] = $val;
							}
							$insertArr['FISUSER'] = 1;
							$insertArr['FNUMBER'] = $entries[$i]["samaccountname"][0];
							$insertArr['FNAME'] = $entries[$i]["name"][0];
							$insertArr['FORG'] = 'test';
							if(is_array($area))
							{
								if(count($area,COUNT_NORMAL) >= 7) {
									//echo "test 5  ";
								}
							} 
							
							
       						$where = 'FNUMBER = '.$entries[$i]["samaccountname"][0];
        					$tableName = 'T_USER';
        					$this->db->select('*');
        					$this->db->where('FNUMBER',$entries[$i]["samaccountname"][0]);
        					$row = $this->db->get('T_USER')->row_array();
							if (isset($row))
							{
    							$result = $this->Tools->updateDataWithFID($insertArr,$tableName,$row['FID']);
							} else {
								$result = $this->Tools->addData($insertArr,$tableName);
							}
    					}

				} 
					//} 
				 
			} else { 
				//echo "<p>No results found!</p>"; 
			} 
		}
		} while ($cookie !== null && $cookie != '');

    return $result;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */