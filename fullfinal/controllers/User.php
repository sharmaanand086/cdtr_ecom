<?php
 
class User extends CI_Controller
{
    public function index()
    {
        if (userLoggedIn()) {
           // echo 'Welcome ' .$this->session->userdata('first_name');
            $this->load->view('header/header');
            $this->load->view('header/css');
            $this->load->view('header/navbar');
            $this->load->view('user/mainHome');
            $this->load->view('header/footer');
        }else{
            setFlashData('alert-danger','please login now.','Login');
        }
    }
    public function logOut()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }
}