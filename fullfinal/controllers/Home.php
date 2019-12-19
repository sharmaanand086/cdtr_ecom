<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
 
	public function index()
	{
		//echo "working";
		
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

	 
	public function aboutus()
	{
		$this->load->view('header/header');
		$this->load->view('css/extracss');
		$this->load->view('header/css');
		$this->load->view('header/navbar');
		$this->load->view('about/mainHome');
		$this->load->view('header/footer');
		 $this->load->view('js/extrajs');
		 $this->load->view('header/htmlclose');
		 
	}
	public function login()
	{
		$this->load->view('header/header');
		$this->load->view('header/css');
		$this->load->view('header/navbar');
		$this->load->view('login/index');
		$this->load->view('header/footer');
	}
}
