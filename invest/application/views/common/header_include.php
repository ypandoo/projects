
<?php

    $CI=&get_instance();
	$CI->load->library('session');
	//$uid = $CI->session->userdata('username');
	
	//$CI->session->set_userdata('username', 'yanglei');
	$username = $CI->session->userdata('username');
	$uid = $CI->session->userdata('uid');
	$userRight = $CI->session->userdata('allow');


	if ($uid) {
	}
	else
	{
		redirect('home/index/login');
	}
?>

<META http-equiv="X-UA-Compatible" content="IE=9" >
<link rel="stylesheet"  type="text/css" href="<?php echo site_url('application/views/common/css/public.css')?>" />
<link rel="stylesheet"  type="text/css" href="<?php echo site_url('application/views/common/css/index.css')?>" />
<link rel="stylesheet"  type="text/css" href="<?php echo site_url('application/views/common/css/font-dincond.css')?>" />
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery-1.8.0.min.js')?>"></script>
<script type="text/javascript" defer="defer" src="<?php echo site_url('application/views/common/js/public.js')?>"></script>
