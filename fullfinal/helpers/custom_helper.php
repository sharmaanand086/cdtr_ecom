<?php 

function  setFlashData($class,$message,$url){
	//echo "working";
	$ci =  get_instance();
	$ci->load->library('session');
	//$ci->session->set_flashdata($class,$message);
	$ci->session->set_flashdata('class',$class);
	$ci->session->set_flashdata('message',$message);
	redirect($url); 
}

function  adminLoggedIn(){
	//echo "working";
	$ci =  get_instance();
	$ci->load->library('session');
	if($ci->session->userdata('aid')){
		return TRUE;
	}else{
		return FALSE;
	}
}

function  userLoggedIn(){
	//echo "working";
	$ci =  get_instance();
	$ci->load->library('session');
	if($ci->session->userdata('uid')){
		return TRUE;
	}else{
		return FALSE;
	}
}

function  getAdminId(){
	//echo "working";
	$ci =  get_instance();
	$ci->load->library('session');
	if($ci->session->userdata('aid')){
		return $ci->session->userdata('aid');
	}else{
		return FALSE;
	}
}
 function checkFlash(){
     $CI = get_instance();
     $CI->load->library('session');
	if ($CI->session->flashdata('class')) {
		$data['class'] =  $CI->session->flashdata('class');
		$data['message'] =  $CI->session->flashdata('message');
		$CI->load->view('flashdata',$data);
	}
 }

 function getSpec($mid){
     $CI = get_instance();
    // $CI->load->library('database');
	 return $CI->db->get_where('specs',array('modelid'=>$mid,'spStatus' =>1));
 }
 function getSpecValue($spid){
     $CI = get_instance();
    // $CI->load->library('database');
	 return $CI->db->get_where('specs_value',array('spid'=>$spid,'spvStatus' =>1));
 }
?>