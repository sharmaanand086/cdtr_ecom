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
					$config['max_size']=100;
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
}