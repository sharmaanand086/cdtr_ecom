<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
 
	public function index()
	{
		//echo "working";
		// setFlashData();
		//die();

		if($this->session->userdata('aid')){
		$this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navbartop');
		$this->load->view('admin/header/navbarleft');
		$this->load->view('admin/home/index');
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
		}else{
			setFlashData('alert-warning','Please Login first to access your admin panel','Admin/Login');
			//$this->session->set_flashdata('error','Please Login first to access your admin panel');
			//redirect('Admin/Login');
		}
		
	}
	public function login(){
		//echo "string";
		 
		$this->load->view('admin/login');
		 
	}
	public function ckeckAdmin(){
		//echo "string";
		$data['aEmail'] = $this->input->post('email',true);
		$data['aPassword'] = $this->input->post('password',true);
		if(!empty($data['aEmail']) && !empty($data['aPassword'])){
			//echo "working";
			$admin = $this->AdminMod->checkAdmin($data);
			var_dump($admin);
			if(count($admin) == 1){
				//echo "found";
				$forSession =  array('aid' =>$admin[0]['aid'],
				'aName' => $admin[0]['aName'],
				'aEmail' =>$admin[0]['aEmail'],
				  );
				var_dump($forSession);
				$this->session->set_userdata($forSession);
				if($this->session->userdata('aid')){
					redirect('admin');
				}else{
					echo'session not created'; 
				}
			}else{
				//echo "not found";
			setFlashData('alert-warning','Email and password is not matched','Admin/Login');
				//$this->session->set_flashdata('error','Email and password is not matched');
			///redirect('Admin/Login');
			}
		}else{
			setFlashData('alert-warning','Please check the Required field !','Admin/Login');
			//$this->session->set_flashdata('error','Please check the Required field !');
			//redirect('Admin/Login');
			//echo "failed";
		}
	}

	public function logout(){
		if($this->session->userdata('aid')){
			$this->session->set_userdata('aid','');
			//$this->session->set_flashdata('error','Seccessfully logout !');
			setFlashData('alert-warning','Seccessfully logout !','Admin/Login');
			//redirect('Admin/Login');
		}else{
			setFlashData('alert-warning','Please login Now !','Admin/Login');
			//$this->session->set_flashdata('error','Please login Now !');
			//redirect('Admin/Login');
		}
	}

	public function NewCategory(){
		if(adminLoggedIn()){
			//echo "admin";
		$this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navbartop');
		$this->load->view('admin/header/navbarleft');
		$this->load->view('admin/home/NewCategory');
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
		}else{
			//echo "user";
			setFlashData('alert-warning','Please Login first to access your admin panel to create category','Admin/Login');
		}
	}

public function NewPrdouct(){
		if(adminLoggedIn()){
			//echo "admin";
		$data['category']= $this->AdminMod->getCategory();
		$this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navbartop');
		$this->load->view('admin/header/navbarleft');
		$this->load->view('admin/home/NewPrdouct',$data);
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
		}else{
			//echo "user";
			setFlashData('alert-warning','Please Login first to access your admin panel to create category','Admin/Login');
		}
	}
	public function NewModel(){
		if(adminLoggedIn()){
			//echo "admin";
		$data['Products']= $this->AdminMod->getProduct();
		$this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navbartop');
		$this->load->view('admin/header/navbarleft');
		$this->load->view('admin/home/NewModel',$data);
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
		}else{
			//echo "user";
			setFlashData('alert-warning','Please Login first to access your admin panel to create category','Admin/Login');
		}
	}

	public function Newspec(){
		if(adminLoggedIn()){
			//echo "admin";
		$data['models']= $this->AdminMod->getModel();
		$this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navbartop');
		$this->load->view('admin/header/navbarleft');
		$this->load->view('admin/home/Newspec',$data);
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
		}else{
			//echo "user";
			setFlashData('alert-warning','Please Login first to access your admin panel to create category','Admin/Login');
		}
	}
	public function addCategory(){
		if(adminLoggedIn()){
			//echo "working";
				$data['cName'] = $this->input->post('categoryName',true);
				if(!empty($data['cName'])){
					$path =  realpath(APPPATH.'../assets/images/categories');
					$config['upload_path']=$path;
					$config['max_size']=100;
					$config['allowed_types']='gif|png|jpeg|jpg';
					 
					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('catDp')){
						$error = $this->upload->display_errors();
						//var_dump($error);
						setFlashData('alert-danger',$error,'Admin/NewCategory');
					}else{
						$fileName = $this->upload->data();
						//var_dump($fileName);
						$data['cDp'] = $fileName['file_name'];
						$data['cDate']= date('Y-m-d h:i:sa');
						$data['adminid']= getAdminId();
					}
					//var_dump($data);
					//die();
					$res1 = $this->AdminMod->checkCategory($data);
					if($res1->num_rows() > 0){
						setFlashData('alert-danger','already exits your category','Admin/NewCategory');
					}else{
						$res = $this->AdminMod->addCategory($data);
					if($res){
					setFlashData('alert-success','You have successfully added your category','Admin/NewCategory');
					}else{
					setFlashData('alert-danger','You can not add now','Admin/NewCategory');
					}
					}
				}else{
			setFlashData('alert-warning','Category Name is Required','Admin/NewCategory');
				}
			}else{
			//echo "user";
			setFlashData('alert-warning','Please Login first to access your admin panel to create category','Admin/Login');
		}
	}

	public function addProduct(){
		if(adminLoggedIn())
		{
			$data['pName'] = $this->input->post('productName',true);
			$data['pCompany'] = $this->input->post('companyName',true);
			$data['categoriyid'] = $this->input->post('categoryId',true);
			//$data['pDp'] = $this->input->post('pDp',true);
				if(!empty($data['pName']) && !empty($data['pCompany']) && !empty($data['categoriyid']) )
				{
					$path =  realpath(APPPATH.'../assets/images/product');
					$config['upload_path']=$path;
					$config['max_size']=100;
					$config['allowed_types']='gif|png|jpeg|jpg';
					 
					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('pDp')){
						$error = $this->upload->display_errors();
						//var_dump($error);
						setFlashData('alert-danger',$error,'Admin/NewPrdouct');
					}else{
						$fileName = $this->upload->data();
						//var_dump($fileName);
						$data['pDp'] = $fileName['file_name'];
						$data['pDate']= date('Y-m-d h:i:sa');
						$data['adminid']= getAdminId();
					}
						$res2 = $this->AdminMod->checkProduct($data);
						if($res2->num_rows() > 0)
						{
						setFlashData('alert-danger','already exits your Product','Admin/NewPrdouct');
						}
						else
						{
						$res2 = $this->AdminMod->addProduct($data);
						if($res2){
						setFlashData('alert-success','You have successfully added your product','Admin/NewPrdouct');
						}else{
					     setFlashData('alert-danger','You can not add now','Admin/NewPrdouct');
						}
						}
				}
				else
				{
				setFlashData('alert-warning','All fields are Required','Admin/NewPrdouct');
				}

		}
		else
		{
			//echo "user";
			setFlashData('alert-warning','Please Login first to access your admin panel to create category','Admin/Login');
		}
	}
	public function addModel(){
		if(adminLoggedIn())
		{
			
			$data['mName'] = $this->input->post('modelName',true);
			$data['mDescription'] = $this->input->post('mdescription',true);
			$data['productid'] = $this->input->post('productid',true);
			$data['mPrice'] = $this->input->post('mPrice',true);
			//$data['pDp'] = $this->input->post('pDp',true);
				if(!empty($data['mName']) && !empty($data['mDescription']) && !empty($data['productid']) && !empty($data['mPrice'])  )
				{
					$path =  realpath(APPPATH.'../assets/images/model');
					$config['upload_path']=$path;
					$config['max_size']=100;
					$config['allowed_types']='gif|png|jpeg|jpg';
					 
					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('mDp')){
						$error = $this->upload->display_errors();
						//var_dump($error);
						setFlashData('alert-danger',$error,'Admin/NewModel');
					}else{
						$fileName = $this->upload->data();
						//var_dump($fileName);
						$data['mDp'] = $fileName['file_name'];
						$data['mDate']= date('Y-m-d h:i:sa');
						$data['adminid']= getAdminId();
					}
						$res2 = $this->AdminMod->checkModel($data);
						if($res2->num_rows() > 0)
						{
						setFlashData('alert-danger','already exits your Model','Admin/NewModel');
						}
						else
						{
						$res2 = $this->AdminMod->addModel($data);
						if($res2){
						setFlashData('alert-success','You have successfully added your Model','Admin/NewModel');
						}else{
					     setFlashData('alert-danger','You can not add now','Admin/NewModel');
						}
						}
				}
				else
				{
				setFlashData('alert-warning','All fields are Required','Admin/NewModel');
				}

		}
		else
		{
			//echo "user";
			setFlashData('alert-warning','Please Login first to access your admin panel to create category','Admin/Login');
		}
	}
public function addspecs(){
	if(adminLoggedIn())
	{
			$data['spName'] = $this->input->post('specName',true);
			$specValues= $this->input->post('spec_value',true); //array
			$specValues= array_filter($specValues);
			$data['modelid'] = $this->input->post('modelId',true);
			//var_dump($specValues);
			//die();
			if(!empty($data['spName'])  && !empty($specValues) && !empty($data['modelid']))
				{
					    $data['spDate']= date('Y-m-d h:i:sa');
						$data['adminid']= getAdminId();

						$res2 = $this->AdminMod->checkspecs($data);
						if($res2->num_rows() > 0)
						{
					 	setFlashData('alert-danger','already exits your spec','Admin/Newspec');
						}
						else
						{
							$specid = $this->AdminMod->checkspecsName($data);
							//var_dump($specid);
							//die();
								if(is_numeric($specid))
							{
											$spec_values = array();
											foreach ($specValues as $specVal) {
												$spec_values[] =  array(
													'spid' =>$specid,
													'adminid'=>$data['adminid'],
													'spvDate' =>date('Y-m-d h:i:sa'),
													'spvName'=>$specVal
												);
											}
											//var_dump($spec_values);
											//var_dump($specVal);
											//die();//foreach ends here 
							$specvalstatus = $this->AdminMod->checkspecsValues($spec_values);
											if($specvalstatus){
												setFlashData('alert-success','You have successfully added your Newspec','Admin/Newspec');
											}else{
			 									setFlashData('alert-danger','You can not add value','Admin/Newspec');
											}
										 				 
							}
							else
							{
							setFlashData('alert-warning','You can not add spec name','Admin/Newspec');
							}
						}
				}
				else
				{
					setFlashData('alert-warning','All fields are Required','Admin/NewModel');
				}
	}
	else
	{
			//echo "user";
	setFlashData('alert-warning','Please Login first to access your admin panel to create category','Admin/Login');
	}
}
	 
	public function allCategory(){
		if(adminLoggedIn()){
		$config['base_url']= site_url('Admin/allCategory');
		$total_rows =  $this->AdminMod->allCategory();
		$config['total_rows']= $total_rows;
		$config['per_page']= 4;
		$config['uri_segment']= 3;
		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$page  = ($this->uri->segment(3) ) ? $this->uri->segment(3):0;
		$data['allCategory']= $this->AdminMod->fetchallCategory($config['per_page'],$page);
		$data['link']=$this->pagination->create_links();
		//$data['allCategory']= $this->AdminMod->allCategory();
	    $this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navbartop');
		$this->load->view('admin/header/navbarleft');
		$this->load->view('admin/home/allCategories',$data);
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
		}else{
				setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
	}

 	public function allPrdoucts(){
 		if(adminLoggedIn())
 		{
 		$config['base_url']= site_url('Admin/allPrdoucts');
		$total_rows =  $this->AdminMod->allproducts();
		$config['total_rows']= $total_rows;
		$config['per_page']= 4;
		$config['uri_segment']= 3;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$page  = ($this->uri->segment(3) ) ? $this->uri->segment(3):0;
		$data['allPrdoucts']= $this->AdminMod->fetchallproducts($config['per_page'],$page);
		$data['link']=$this->pagination->create_links();

 		$this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navbartop');
		$this->load->view('admin/header/navbarleft');
		$this->load->view('admin/home/allproducts',$data);
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
 		}
 		else
 		{
		setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
 	}
 	public function allmodel(){
 		if(adminLoggedIn())
 		{
 		$config['base_url']= site_url('Admin/allmodel');
		$total_rows =  $this->AdminMod->allproducts();
		$config['total_rows']= $total_rows;
		$config['per_page']= 4;
		$config['uri_segment']= 3;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$page  = ($this->uri->segment(3) ) ? $this->uri->segment(3):0;
		$data['allmodel']= $this->AdminMod->fetchallModels($config['per_page'],$page);
		$data['link']=$this->pagination->create_links();

 		$this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navbartop');
		$this->load->view('admin/header/navbarleft');
		$this->load->view('admin/home/allmodels',$data);
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
 		}
 		else
 		{
		setFlashData('alert-warning','Please Login first to access All allmodels','Admin/Login');
		}
 	}
 	public function allspec(){
 		if(adminLoggedIn())
 		{
 		$config['base_url']= site_url('Admin/allspec');
		$total_rows =  $this->AdminMod->getallspec();
		$config['total_rows']= $total_rows;
		$config['per_page']= 4;
		$config['uri_segment']= 3;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$page  = ($this->uri->segment(3) ) ? $this->uri->segment(3):0;
		$data['allspec']= $this->AdminMod->fetchallspecs($config['per_page'],$page);
		$data['link']=$this->pagination->create_links();

 		$this->load->view('admin/header/header');
		$this->load->view('admin/header/css');
		$this->load->view('admin/header/navbartop');
		$this->load->view('admin/header/navbarleft');
		$this->load->view('admin/home/allspec',$data);
		$this->load->view('admin/header/footer');
		$this->load->view('admin/header/htmlclose');
 		}
 		else
 		{
		setFlashData('alert-warning','Please Login first to access All allmodels','Admin/Login');
		}

 	}
	public function editCategory($cid){
		if(adminLoggedIn()){
			if(!empty($cid) && isset($cid)){
				$data['category']=  $this->AdminMod->checkCategoryById($cid);
				if(count($data['category']) == 1)
				{
					//echo "found";
					$this->load->view('admin/header/header');
					$this->load->view('admin/header/css');
					$this->load->view('admin/header/navbartop');
					$this->load->view('admin/header/navbarleft');
					$this->load->view('admin/home/editCategory',$data);
					$this->load->view('admin/header/footer');
					$this->load->view('admin/header/htmlclose');
				}
				else
				{
					//echo "not found";
					setFlashData('alert-warning','category Not found ','Admin/allCategory');
				}
			}
			else
			{
				setFlashData('alert-warning','somthing went wrong','Admin/allCategory');
			}

		}
		else{
			setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
	}
 
	 public function editproduct($pid){
	 	if(adminLoggedIn()){
			if(!empty($pid) && isset($pid)){
				$data['product']=  $this->AdminMod->checkProductById($pid);				 
				if(count($data['product']) == 1)
				{
					//echo "found";
					$data['category']= $this->AdminMod->getCategory();
					$this->load->view('admin/header/header');
					$this->load->view('admin/header/css');
					$this->load->view('admin/header/navbartop');
					$this->load->view('admin/header/navbarleft');
					$this->load->view('admin/home/editproduct',$data);
					$this->load->view('admin/header/footer');
					$this->load->view('admin/header/htmlclose');
				}
				else
				{
					//echo "not found";
					setFlashData('alert-warning','Prouduct Not found ','Admin/allPrdoucts');
				}
			}
			else
			{
				setFlashData('alert-warning','somthing went wrong','Admin/allPrdoucts');
			}

		}
		else{
			setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
	 }

	  public function editModel($mid){
	 	if(adminLoggedIn()){
			if(!empty($mid) && isset($mid)){
				$data['model']=  $this->AdminMod->checkmodelById($mid);				 
				if(count($data['model']) == 1)
				{
					//echo "found";
					$data['Products']= $this->AdminMod->getProduct();
					//$data['category']= $this->AdminMod->getCategory();
					$this->load->view('admin/header/header');
					$this->load->view('admin/header/css');
					$this->load->view('admin/header/navbartop');
					$this->load->view('admin/header/navbarleft');
					$this->load->view('admin/home/editmodel',$data);
					$this->load->view('admin/header/footer');
					$this->load->view('admin/header/htmlclose');
				}
				else
				{
					//echo "not found";
					setFlashData('alert-warning','Model Not found ','Admin/allmodel');
				}
			}
			else
			{
				setFlashData('alert-warning','somthing went wrong','Admin/allmodel');
			}

		}
		else{
			setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
	 }
	public function updateCategory(){
		if(adminLoggedIn()){
			$data['cName'] = $this->input->post('categoryName',true);			
			$oldimage = $this->input->post('oldimage',true);

			$cid = $this->input->post('cid',true);
			if(!empty($data['cName']) && isset($data['cName'])){

				if(isset($_FILES['catDp']) && is_uploaded_file($_FILES['catDp']['tmp_name']))
				{
					$path =  realpath(APPPATH.'../assets/images/categories');
					$config['upload_path']=$path;
					$config['max_size']=500;
					$config['allowed_types']='gif|png|jpeg|jpg';
					 
					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('catDp')){
						$error = $this->upload->display_errors();
						//var_dump($error);
						setFlashData('alert-danger',$error,'Admin/allCategory');
					}else{
						$fileName = $this->upload->data();
						//var_dump($fileName);
						$data['cDp'] = $fileName['file_name'];
						 
					}
				}//image checking here
				$result = $this->AdminMod->updateCategory($data,$cid);
				if($result){
					if(!empty($data['cName']) && isset($data['cName'])){
						if(file_exists($path.'/'.$oldimage)){
							unlink($path.'/'.$oldimage);
						}
					}
					setFlashData('alert-warning','Category Name Updated successfully','Admin/allCategory');
				}else{
					setFlashData('alert-warning','You can not update category','Admin/allCategory');
				}
			}else{
			setFlashData('alert-warning','Category Name is Required','Admin/allCategory');
			}

		}else{
			setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
	}

	public function updateProduct(){
      if(adminLoggedIn())
		      {
			$data['pName'] = $this->input->post('productName',true);
			$data['pCompany'] = $this->input->post('companyName',true);
			$data['categoriyid'] = $this->input->post('categoryId',true);
			$pid = $this->input->post('pid',true);
			$oldimage = $this->input->post('oldimage',true);
			//$data['pDp'] = $this->input->post('pDp',true);
				if(!empty($data['pName']) && !empty($data['pCompany']) && !empty($data['categoriyid']) )
				{
					if(isset($_FILES['propDp']) && is_uploaded_file($_FILES['propDp']['tmp_name']))
				{
					$path =  realpath(APPPATH.'../assets/images/product');
					$config['upload_path']=$path;
					$config['max_size']=100;
					$config['allowed_types']='gif|png|jpeg|jpg';
					 
					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('propDp')){
						$error = $this->upload->display_errors();
						//var_dump($error);
						setFlashData('alert-danger',$error,'Admin/allPrdoucts');
					}else{
						$fileName = $this->upload->data();
						//var_dump($fileName);
						$data['pDp'] = $fileName['file_name'];
						 
					}
				}//image checking here
						$res2 = $this->AdminMod->checkProduct($data);
						if($res2->num_rows() > 0)
						{
						setFlashData('alert-danger','already exits your Product','Admin/allPrdoucts');
						}
						else
						{
						$res2 = $this->AdminMod->updateProduct($data,$pid);
						if($res2){
						if(!empty($data['pDp']) && isset($data['pDp'])){
						if(file_exists($path.'/'.$oldimage)){
							unlink($path.'/'.$oldimage);
						}
					}	
						setFlashData('alert-success','You have successfully updated your product','Admin/allPrdoucts');
						}else{
					     setFlashData('alert-danger','You can not updated now','Admin/allPrdoucts');
						}
						}
				}
				else
				{
				setFlashData('alert-warning','All fields are Required','Admin/allPrdoucts');
				}

			   }
		else
		{
			setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
	}

	public function updatemodel(){
		if(adminLoggedIn())
		      {
			$data['mName'] = $this->input->post('modelName',true);
			$data['mDescription'] = $this->input->post('mdescription',true);
			$data['productid'] = $this->input->post('productid',true);
			$data['mPrice'] = $this->input->post('modelPrice',true);			
			$mid = $this->input->post('id',true);
			$oldimage = $this->input->post('oldimage',true);
			//$data['pDp'] = $this->input->post('pDp',true);
				if(!empty($data['mName']) && !empty($data['mDescription']) && !empty($data['productid']) && !empty($data['mPrice']) )
				{
					if(isset($_FILES['modeldp']) && is_uploaded_file($_FILES['modeldp']['tmp_name']))
				{
					$path =  realpath(APPPATH.'../assets/images/model');
					$config['upload_path']=$path;
					$config['max_size']=100;
					$config['allowed_types']='gif|png|jpeg|jpg';
					 
					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('modeldp')){
						$error = $this->upload->display_errors();
						//var_dump($error);
						setFlashData('alert-danger',$error,'Admin/allmodel');
					}else{
						$fileName = $this->upload->data();
						//var_dump($fileName);
						$data['mDp'] = $fileName['file_name'];
						 
					}
				}//image checking here
						$res2 = $this->AdminMod->checkmodel($data);
						if($res2->num_rows() > 0)
						{
						setFlashData('alert-danger','already exits your model','Admin/allmodel');
						}
						else
						{
						$res2 = $this->AdminMod->updateModel($data,$mid);
						if($res2){
						if(!empty($data['mDp']) && isset($data['mDp'])){
						if(file_exists($path.'/'.$oldimage)){
							unlink($path.'/'.$oldimage);
						}
					}	
						setFlashData('alert-success','You have successfully updated your model','Admin/allmodel');
						}else{
					     setFlashData('alert-danger','You can not updated now','Admin/allmodel');
						}
						}
				}
				else
				{
				setFlashData('alert-warning','All fields are Required','Admin/allmodel');
				}

			   }
		else
		{
			setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}

	}
	public function deletecategory(){
		if(adminLoggedIn()){
			if($this->input->is_ajax_request())
			{
				$this->input->post('id',true);
				$cid =	$this->input->post('text',true);
				if(!empty($cid) && isset($cid)){
					//echo "found";
				    $cid = $this->encryption->decrypt($cid);
				    $oldimage = $this->AdminMod->getCategoryImage($cid);
				    if(!empty($oldimage) && count($oldimage) == 1 ){
				    	$realimg = $oldimage[0]['cDp'];
				    }
					//die();
					$checkMd = $this->AdminMod->deletecategory($cid);
					if($checkMd){
						if(!empty($realimg) && isset($realimg)){
							$path =  realpath(APPPATH.'../assets/images/categories');
						if(file_exists($path.'/'.$realimg)){
							unlink($path.'/'.$realimg);
						}
					}
						//echo "successfully deleted";
					$data['return'] = true;
					$data['message'] = 'successfully deleted';
					echo json_encode($data);
					}else{
						//echo "you can not delete category right now";
					$data['return'] = false;
					$data['message'] = 'you can not delete category right now';
					echo json_encode($data);
					}

				}else{
					//echo "value not exist";
					$data['return'] = false;
					$data['message'] = 'value not exist';
					echo json_encode($data);
				}
			}
			else
			{
			setFlashData('alert-warning','Something went wrong','Admin');
			}
			}
			else
			{
			setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
	}

public function deleteProduct(){
		if(adminLoggedIn()){
			if($this->input->is_ajax_request())
			{
				$this->input->post('id',true);
				$pid =	$this->input->post('text',true);
				if(!empty($pid) && isset($pid)){
					//echo "found";
				    $pid = $this->encryption->decrypt($pid);
				    $oldimage = $this->AdminMod->getProductImage($pid);
				    if(!empty($oldimage) && count($oldimage) == 1 ){
				    	$realimg = $oldimage[0]['pDp'];
				    }
					//die();
					$checkMd = $this->AdminMod->deleteProduct($pid);
					if($checkMd){
						if(!empty($realimg) && isset($realimg)){
							$path =  realpath(APPPATH.'../assets/images/product');
						if(file_exists($path.'/'.$realimg)){
							unlink($path.'/'.$realimg);
						}
					}
						//echo "successfully deleted";
					$data['return'] = true;
					$data['message'] = 'successfully deleted';
					echo json_encode($data);
					}else{
						//echo "you can not delete category right now";
					$data['return'] = false;
					$data['message'] = 'you can not delete category right now';
					echo json_encode($data);
					}

				}else{
					//echo "value not exist";
					$data['return'] = false;
					$data['message'] = 'value not exist';
					echo json_encode($data);
				}
			}
			else
			{
			setFlashData('alert-warning','Something went wrong','Admin');
			}
			}
			else
			{
			setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
	}


public function deletemodel(){
		if(adminLoggedIn()){
			if($this->input->is_ajax_request())
			{
				$this->input->post('id',true);
				$mid =	$this->input->post('text',true);
				if(!empty($mid) && isset($mid)){
					//echo "found";
				    $mid = $this->encryption->decrypt($mid);
				    $oldimage = $this->AdminMod->getModelImage($mid);
				    if(!empty($oldimage) && count($oldimage) == 1 ){
				    	$realimg = $oldimage[0]['mDp'];
				    }
					//die();
					$checkMd = $this->AdminMod->deletemodel($mid);
					if($checkMd){
						if(!empty($realimg) && isset($realimg)){
							$path =  realpath(APPPATH.'../assets/images/model');
						if(file_exists($path.'/'.$realimg)){
							unlink($path.'/'.$realimg);
						}
					}
						//echo "successfully deleted";
					$data['return'] = true;
					$data['message'] = 'successfully deleted';
					echo json_encode($data);
					}else{
						//echo "you can not delete category right now";
					$data['return'] = false;
					$data['message'] = 'you can not delete model right now';
					echo json_encode($data);
					}

				}else{
					//echo "value not exist";
					$data['return'] = false;
					$data['message'] = 'value not exist';
					echo json_encode($data);
				}
			}
			else
			{
			setFlashData('alert-warning','Something went wrong','Admin');
			}
			}
			else
			{
			setFlashData('alert-warning','Please Login first to access All category','Admin/Login');
		}
	}

	 public function deleteSpec()
    {
        if (adminLoggedIn()) {
            if ($this->input->is_ajax_request()) {
                $this->input->post('id',true);
                $mId  = $this->input->post('text',true);
                if (!empty($mId) && isset($mId)) {
                    $mId = $this->encryption->decrypt($mId);
                    $checkMd = $this->AdminMod->deleteSpecnow($mId);
                    if ($checkMd) {
                        $data['return'] = true;
                        $data['message'] = 'successfully deleted';
                        echo json_encode($data);
                    } else {
                        $data['return'] = false;
                        $data['message'] = 'you can\'t delete your Spec right now';
                        echo json_encode($data);
                    }
                }
                else{
                    $data['return'] = false;
                    $data['message'] = 'value not exist';
                    echo json_encode($data);
                }
            }
            else{
                setFlashData('alert-danger','Something went wrong.','Admin');
            }
        } else {
            setFlashData('alert-danger','Please login first.','Admin/login');
        }
    }

public function editSpec($pId)
    {
        if (adminLoggedIn()) {
            if (!empty($pId) && isset($pId)) {
                $data['Spec'] = $this->AdminMod->checkSpecById($pId);
                if (count($data['Spec']) == 1) {
                    $data['models'] = $this->AdminMod->getModel();                    

                    $this->load->view('admin/header/header');
					$this->load->view('admin/header/css');
					$this->load->view('admin/header/navbartop');
					$this->load->view('admin/header/navbarleft');
					 $this->load->view('admin/home/editSpec',$data);
					$this->load->view('admin/header/footer');
					$this->load->view('admin/header/htmlclose');


                } else {
                    setFlashData('alert-danger','specs not found.','Admin/allspec');
                }
            } else {
                setFlashData('alert-danger','Something went wrong','Admin/allspec');
            }
        } else {
            setFlashData('alert-danger','Please login first to edit your specs.','Admin/login');
        }
    }
    public function updateSpec()
    {
        if (adminLoggedIn()) {
            $data['spName'] = $this->input->post('sp_name',true);
            $data['modelid'] = $this->input->post('modelid',true);
            $SpecId = $this->input->post('specid',true);
             var_dump($secValues);
            if (
                !empty($data['spName']) && !empty($SpecId) && !empty($data['modelid'])
            )
            {
                $addDAta = $this->AdminMod->checkSpecs($data);
                if ($addDAta->num_rows() > 0) {
                    setFlashData('alert-danger','The Product already exist.','admin/allspec');
                }
                else{
                    $updateSpec = $this->AdminMod->updateSpec($data,$SpecId);
                    if ($updateSpec){
                        setFlashData('alert-success','You have successfully updated your Spec.','Admin/allspec');
                    }
                    else{
                        setFlashData('alert-danger','You can\'t updated your Spec  right now.','Admin/allspec');
                    }
                }
            } else {
                setFlashData('alert-danger','Please check the required fields and try again','Admin/allspec');
            }
        } else {
            setFlashData('alert-danger','Please login first to add your category.','admin/login');
        }
    }
}//class ends here 