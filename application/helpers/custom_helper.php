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
 

?>