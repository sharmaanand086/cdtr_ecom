<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Models extends CI_Controller {

public function index(){
		$data['allmodels'] = $this->HomeMod->getAllmodels(8);
		$data['allcategories'] = $this->HomeMod->getAllcategories();
		//var_dump($data['allproducts']->num_rows());
		//die();
		$this->load->view('header/header');
		$this->load->view('header/css');
		$this->load->view('header/navbar');
		$this->load->view('home/mainHome',$data);
		$this->load->view('header/footer');
}

public function myModels($id){
		if(!empty($id)){
		$data['speItem']  =	$this->HomeMod->checkModel($id);
		//var_dump($data['speItem']->num_rows());
		//die();

		if(count($data['speItem']) == 1){
			$this->load->view('header/header');
			$this->load->view('header/css');
			$this->load->view('header/navbar');
			$this->load->view('model/model',$data);
			$this->load->view('header/footer');
		}else{
			echo "Product not found";
		}
		
		}else{
			echo "error";
		}
		
}
}//end class here
 